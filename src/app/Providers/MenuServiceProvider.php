<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasPermissions;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('partials.admin.navigation', function ($view) {
            $menuItems = $this->buildMenuItems();
            $view->with('menuItems', $menuItems);
        });
    }

    /**
     * Build menu items from configuration
     */
    protected function buildMenuItems(): array
    {
        $menuConfig = config('menu.items', []);
        $menuItems = [];

        foreach ($menuConfig as $item) {
            $processedItem = $this->processMenuItem($item);
            if ($processedItem !== null) {
                $menuItems[] = $processedItem;
            }
        }

        return $menuItems;
    }

    /**
     * Process a single menu item
     */
    protected function processMenuItem(array $item): ?array
    {
        // Handle separator items
        if (isset($item['separator']) && $item['separator'] === true) {
            return [
                'is_separator' => true,
                'text' => $item['text'] ?? null, // Optional separator text/heading
                'has_children' => false,
                'is_active' => false,
                'url_resolved' => '#',
            ];
        }

        // Check permissions
        if (isset($item['permission']) && !$this->hasPermission($item['permission'])) {
            return null;
        }

        // Process children if they exist
        if (isset($item['children']) && !empty($item['children'])) {
            $processedChildren = [];
            foreach ($item['children'] as $child) {
                $processedChild = $this->processMenuItem($child);
                if ($processedChild !== null) {
                    $processedChildren[] = $processedChild;
                }
            }

            // If no visible children, don't show parent
            if (empty($processedChildren)) {
                return null;
            }

            $item['children'] = $processedChildren;
        }

        // Add computed properties
        $item['is_active'] = $this->isMenuItemActive($item);
        $item['url_resolved'] = $this->resolveUrl($item);
        $item['has_children'] = isset($item['children']) && !empty($item['children']);

        return $item;
    }

    /**
     * Resolve URL based on item configuration
     */
    protected function resolveUrl(array $item): string
    {
        // Direct URL (relative or absolute)
        if (isset($item['url'])) {
            $url = $item['url'];
            // Add query parameters if specified
            if (isset($item['query']) && !empty($item['query'])) {
                $url .= '?' . http_build_query($item['query']);
            }
            return $url;
        }

        // Named route
        if (isset($item['route'])) {
            try {
                $routeParams = $item['route_params'] ?? [];
                $queryParams = $item['query'] ?? [];

                $url = route($item['route'], $routeParams);

                // Add query parameters if specified
                if (!empty($queryParams)) {
                    $url .= '?' . http_build_query($queryParams);
                }

                return $url;
            } catch (\Exception $e) {
                return '#';
            }
        }

        // Controller action
        if (isset($item['action'])) {
            try {
                $actionParams = $item['action_params'] ?? [];
                $queryParams = $item['query'] ?? [];

                $url = action($item['action'], $actionParams);

                // Add query parameters if specified
                if (!empty($queryParams)) {
                    $url .= '?' . http_build_query($queryParams);
                }

                return $url;
            } catch (\Exception $e) {
                return '#';
            }
        }

        return '#';
    }

    /**
     * Check if menu item is active
     */
    protected function isMenuItemActive(array $item): bool
    {
        if (!isset($item['active'])) {
            return false;
        }

        $currentRoute = request()->route() ? request()->route()->getName() : '';

        foreach ($item['active'] as $pattern) {
            if (fnmatch($pattern, $currentRoute)) {
                return true;
            }
        }

        // Check children for active state
        if (isset($item['children'])) {
            foreach ($item['children'] as $child) {
                if ($this->isMenuItemActive($child)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if user has permission (supports string or array of permissions)
     */
    protected function hasPermission(string|array $permission): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();

        // Handle array of permissions (OR logic - user needs ANY of the permissions)
        if (is_array($permission)) {
            foreach ($permission as $perm) {
                if ($this->checkSinglePermission($perm)) {
                    return true;
                }
            }
            return false;
        }

        // Handle single permission
        return $this->checkSinglePermission($permission);
    }

    /**
     * Check a single permission
     */
    protected function checkSinglePermission(string $permission): bool
    {
        try {
            // Use Laravel's Gate to check permissions
            return \Illuminate\Support\Facades\Gate::allows($permission);
        } catch (\Exception $e) {
            return false;
        }
    }
}
