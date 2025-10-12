<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Routing\Controllers\Middleware;

trait HasPermissionMiddleware
{
    /**
     * Get the base middleware that should be assigned to controllers using this trait.
     */
    public static function getBaseMiddleware(): array
    {
        return [
            'auth', 
            'verified'
        ];
    }

    /**
     * Get permission-based middleware for a given resource.
     * 
     * @param string $resource The resource name (e.g., 'users', 'posts', 'roles')
     * @return array
     */
    public static function getPermissionMiddleware(string $resource): array
    {
        return [
            new Middleware("can:view {$resource}", ['index', 'show']),
            new Middleware("can:create {$resource}", ['create', 'store']),
            new Middleware("can:edit {$resource}", ['edit', 'update']),
            new Middleware("can:delete {$resource}", ['destroy']),
        ];
    }

    /**
     * Get complete middleware array for a resource with base middleware.
     * 
     * @param string $resource The resource name
     * @param array $additionalMiddleware Additional middleware to include
     * @return array
     */
    public static function getResourceMiddleware(string $resource, array $additionalMiddleware = []): array
    {
        return array_merge(
            static::getBaseMiddleware(),
            static::getPermissionMiddleware($resource),
            $additionalMiddleware
        );
    }

    /**
     * Get middleware for custom actions with specific permissions.
     * 
     * @param string $permission The permission name
     * @param array $actions The actions this permission applies to
     * @return Middleware
     */
    public static function getCustomPermissionMiddleware(string $permission, array $actions): Middleware
    {
        return new Middleware("can:{$permission}", $actions);
    }
}
