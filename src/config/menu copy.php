<?php

return [
    'items' => [
        [
            'text' => 'Dashboard',
            'route' => 'admin.dashboard',
            'icon' => 'home',
            'active' => ['admin.dashboard'],
        ],
        [
            'separator' => true,
        ],
        [
            'text' => 'Settings',
            'icon' => 'settings',
            'active' => ['admin.users.*', 'admin.roles.*', 'admin.permissions.*'],
            'children' => [
                [
                    'text' => 'Users',
                    'route' => 'admin.users.index',
                    'icon' => 'user',
                    'active' => ['admin.users.*'],
                ],
                [
                    'text' => 'Roles',
                    'route' => 'admin.roles.index',
                    'icon' => 'shield',
                    'active' => ['admin.roles.*'],
                ],
                [
                    'text' => 'Permissions',
                    'route' => 'admin.permissions.index',
                    'icon' => 'key',
                    'active' => ['admin.permissions.*'],
                ],
            ],
        ],
        [
            'separator' => true,
        ],
        [
            'text' => 'User Management',
            'icon' => 'users',
            'active' => ['admin.users.*', 'admin.roles.*', 'admin.permissions.*'],
            'children' => [
                [
                    'text' => 'Users List',
                    'route' => 'admin.users.index',
                ],
                [
                    'text' => 'Roles List',
                    'route' => 'admin.roles.index',
                ],
                [
                    'text' => 'Permissions List',
                    'route' => 'admin.permissions.index',
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
