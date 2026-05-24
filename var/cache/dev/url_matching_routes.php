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
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/album' => [[['_route' => 'admin_album_index', '_controller' => 'App\\Controller\\Admin\\AlbumController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/album/add' => [[['_route' => 'admin_album_add', '_controller' => 'App\\Controller\\Admin\\AlbumController::add'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/invites' => [[['_route' => 'admin_invite_index', '_controller' => 'App\\Controller\\Admin\\InviteController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/invites/new' => [[['_route' => 'admin_invite_new', '_controller' => 'App\\Controller\\Admin\\InviteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/media' => [[['_route' => 'admin_media_index', '_controller' => 'App\\Controller\\Admin\\MediaController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/media/add' => [[['_route' => 'admin_media_add', '_controller' => 'App\\Controller\\Admin\\MediaController::add'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/login' => [[['_route' => 'admin_login', '_controller' => 'App\\Controller\\Admin\\SecurityController::login'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::home'], null, null, null, false, false, null]],
        '/guests' => [[['_route' => 'guests', '_controller' => 'App\\Controller\\HomeController::guests'], null, null, null, false, false, null]],
        '/about' => [[['_route' => 'about', '_controller' => 'App\\Controller\\HomeController::about'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/(?'
                        .'|font/([^/\\.]++)\\.woff2(*:98)'
                        .'|([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:134)'
                                .'|router(*:148)'
                                .'|exception(?'
                                    .'|(*:168)'
                                    .'|\\.css(*:181)'
                                .')'
                            .')'
                            .'|(*:191)'
                        .')'
                    .')'
                .')'
                .'|/admin/(?'
                    .'|album/(?'
                        .'|update/([^/]++)(*:236)'
                        .'|delete/([^/]++)(*:259)'
                    .')'
                    .'|invites/([^/]++)/(?'
                        .'|block(*:293)'
                        .'|delete(*:307)'
                    .')'
                    .'|media/delete/([^/]++)(*:337)'
                .')'
                .'|/guest/([^/]++)(*:361)'
                .'|/portfolio(?:/(\\d+))?(*:390)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        98 => [[['_route' => '_profiler_font', '_controller' => 'web_profiler.controller.profiler::fontAction'], ['fontName'], null, null, false, false, null]],
        134 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        148 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        168 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        181 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        191 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        236 => [[['_route' => 'admin_album_update', '_controller' => 'App\\Controller\\Admin\\AlbumController::update'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        259 => [[['_route' => 'admin_album_delete', '_controller' => 'App\\Controller\\Admin\\AlbumController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        293 => [[['_route' => 'admin_invite_block', '_controller' => 'App\\Controller\\Admin\\InviteController::block'], ['id'], ['POST' => 0], null, false, false, null]],
        307 => [[['_route' => 'admin_invite_delete', '_controller' => 'App\\Controller\\Admin\\InviteController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        337 => [[['_route' => 'admin_media_delete', '_controller' => 'App\\Controller\\Admin\\MediaController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        361 => [[['_route' => 'guest', '_controller' => 'App\\Controller\\HomeController::guest'], ['id'], null, null, false, true, null]],
        390 => [
            [['_route' => 'portfolio', 'id' => null, '_controller' => 'App\\Controller\\HomeController::portfolio'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
