<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/album' => [[['_route' => 'admin_album_index', '_controller' => 'App\\Controller\\Admin\\AlbumController::index'], null, null, null, false, false, null]],
        '/admin/album/add' => [[['_route' => 'admin_album_add', '_controller' => 'App\\Controller\\Admin\\AlbumController::add'], null, null, null, false, false, null]],
        '/admin/media' => [[['_route' => 'admin_media_index', '_controller' => 'App\\Controller\\Admin\\MediaController::index'], null, null, null, false, false, null]],
        '/admin/media/add' => [[['_route' => 'admin_media_add', '_controller' => 'App\\Controller\\Admin\\MediaController::add'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'admin_login', '_controller' => 'App\\Controller\\Admin\\SecurityController::login'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::home'], null, null, null, false, false, null]],
        '/guests' => [[['_route' => 'guests', '_controller' => 'App\\Controller\\HomeController::guests'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\HomeController::about'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/admin/(?'
                    .'|album/(?'
                        .'|update/([^/]++)(*:203)'
                        .'|delete/([^/]++)(*:226)'
                    .')'
                    .'|media/delete/([^/]++)(*:256)'
                .')'
                .'|/guest/([^/]++)(*:280)'
                .'|/portfolio(?:/([^/]++))?(*:312)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        203 => [[['_route' => 'admin_album_update', '_controller' => 'App\\Controller\\Admin\\AlbumController::update'], ['id'], null, null, false, true, null]],
        226 => [[['_route' => 'admin_album_delete', '_controller' => 'App\\Controller\\Admin\\AlbumController::delete'], ['id'], null, null, false, true, null]],
        256 => [[['_route' => 'admin_media_delete', '_controller' => 'App\\Controller\\Admin\\MediaController::delete'], ['id'], null, null, false, true, null]],
        280 => [[['_route' => 'guest', '_controller' => 'App\\Controller\\HomeController::guest'], ['id'], null, null, false, true, null]],
        312 => [
            [['_route' => 'portfolio', 'id' => null, '_controller' => 'App\\Controller\\HomeController::portfolio'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
