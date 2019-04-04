<?php
return [

    // admin nav
    'admin' => [
        'dashboard'   => [
            'icon'        => '<i class="fas fa-tachometer-alt fa-fw"></i>',
            'trans'       => 'nav.admin.dashboard',
            'route'       => 'dashboard',
            'class'       => ['spin-on-click'],
        ],
        'divider',
        'news'        => [
            'icon'    => '<i class="fas fa-newspaper fa-fw"></i>',
            'trans'   => 'nav.admin.news',
            'subMenu' => [
                [
                    'icon'             => '<i class="fas fa-tags fa-fw"></i>',
                    'trans'            => 'nav.admin.categories',
                    'route'            => 'news.categories',
                    'class'            => ['spin-on-click'],
                    'activeWithRoutes' => [
                        'news.categories',
                        'news.category.create',
                        'news.category.edit',
                    ],
                ],
                [
                    'icon'             => '<i class="fas fa-pen fa-fw"></i>',
                    'trans'            => 'nav.admin.articles',
                    'route'            => 'news.articles',
                    'class'            => ['spin-on-click'],
                    'activeWithRoutes' => [
                        'news.articles',
                        'news.article.create',
                        'news.article.edit',
                    ],
                ],
            ],
        ],
        'simplePages' => [
            'icon'             => '<i class="fas fa-file-alt fa-fw"></i>',
            'trans'            => 'nav.admin.simplePages',
            'route'            => 'simplePages',
            'class'            => ['spin-on-click'],
            'activeWithRoutes' => [
                'simplePage.create',
                'simplePage.edit',
            ],
        ],
        'divider',
        'settings'    => [
            'icon'        => '<i class="fas fa-cogs fa-fw"></i>',
            'trans'       => 'nav.admin.settings',
            'route'       => 'settings',
            'class'       => ['spin-on-click'],
        ],
        'users'       => [
            'icon'             => '<i class="fas fa-users fa-fw"></i>',
            'trans'            => 'nav.admin.users',
            'route'            => 'users',
            'class'            => ['spin-on-click'],
            'activeWithRoutes' => [
                'user.create',
                'user.edit',
            ],
        ],
        'divider',
        'back'        => [
            'icon'        => '<i class="fas fa-undo fa-fw"></i>',
            'trans'       => 'nav.admin.back',
            'route'       => 'home',
            'class'       => ['new-window'],
        ],
    ],
];
