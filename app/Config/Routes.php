<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');

$routes->get('admin', 'Admin\Dashboard::index');

$routes->get('admin/websites', 'Admin\Website::index');

$routes->get('admin/templates', 'Admin\Template::index');

$routes->get('admin/section-types', 'Admin\SectionType::index');
