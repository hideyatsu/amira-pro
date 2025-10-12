<?php

return [
    'items' => [
        [
            'text' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'home',
            'active' => ['admin.dashboard'],
            'permission' => 'view dashboard',
        ],

        // Separator
        [
            'separator' => true,
        ],

        // Multi-column dropdown menu (like Tabler Interface example)
        [
            'text' => 'Settings',
            'icon' => 'settings',
            'permission' => ['view users', 'view roles', 'view permissions'],
            'active' => ['admin.users.*', 'admin.roles.*', 'admin.permissions.*'],
            'dropdown_type' => 'columns', // Multi-column dropdown
            'dropdown_columns' => 1, // Number of columns
            'children' => [
                // Column 1 items
                [
                    'text' => 'User Management',
                    'icon' => 'user-cog',
                    'permission' => ['view users', 'view roles', 'view permissions'],
                    'active' => ['admin.users.*', 'admin.roles.*', 'admin.permissions.*'],
                    'column' => 1,
                    'dropdown_type' => 'nested', // Nested dropdown (dropend)
                    'children' => [
                        [
                            'text' => 'Users',
                            'route' => 'admin.users.index',
                            'icon' => 'users',
                            'active' => ['admin.users.*'],
                            'permission' => 'view users',
                        ],
                        [
                            'text' => 'Roles',
                            'route' => 'admin.roles.index',
                            'icon' => 'tie',
                            'active' => ['admin.roles.*'],
                            'permission' => 'view roles',
                        ],
                        [
                            'text' => 'Permissions',
                            'route' => 'admin.permissions.index',
                            'icon' => 'key',
                            'active' => ['admin.permissions.*'],
                            'permission' => 'view permissions',
                        ],
                    ],
                ],
            ],
        ],
    ],

    // Menu rendering options
    'options' => [
        'parent_class' => 'navbar-nav',
        'item_class' => 'nav-item',
        'link_class' => 'nav-link',
        'active_class' => 'active',
        'dropdown_class' => 'dropdown',
        'dropdown_toggle_class' => 'nav-link dropdown-toggle',
        'dropdown_menu_class' => 'dropdown-menu',
        'dropdown_item_class' => 'dropdown-item',
        'icon_prefix' => 'nav-link-icon d-md-none d-lg-inline-block',
        'title_prefix' => 'nav-link-title',
    ],
];
