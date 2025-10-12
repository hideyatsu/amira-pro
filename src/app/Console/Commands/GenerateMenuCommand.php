<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateMenuCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menu:generate {name} {--url=} {--raw=} {--action=} {--icon=} {--permission=} {--parent=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new menu item configuration';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $url = $this->option('url');
        $raw = $this->option('raw');
        $action = $this->option('action');
        $icon = $this->option('icon');
        $permission = $this->option('permission');
        $parent = $this->option('parent');

        $menuItem = [
            'text' => $name,
        ];

        if ($url) {
            $menuItem['url'] = $url;
        } elseif ($raw) {
            $menuItem['raw'] = $raw;
        } elseif ($action) {
            $menuItem['action'] = $action;
        }

        if ($icon) {
            $menuItem['icon'] = $icon;
        }

        if ($permission) {
            $menuItem['permission'] = $permission;
        }

        // Generate active pattern based on URL
        if ($url) {
            $menuItem['active'] = [$url . '*'];
        }

        $this->info('Generated menu item configuration:');
        $this->line('');
        $this->line(var_export($menuItem, true));
        $this->line('');
        $this->info('Add this to your config/menu.php file in the appropriate location.');

        if ($parent) {
            $this->warn("Remember to add this as a child of the '{$parent}' menu item.");
        }
    }
}
