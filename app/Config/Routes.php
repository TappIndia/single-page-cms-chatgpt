<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');

$routes->get('admin', 'Admin\Dashboard::index');

$routes->get('admin/websites', 'Admin\Website::index');

$routes->get('admin/templates', 'Admin\Template::index');

$routes->get('admin/section-types', 'Admin\SectionType::index');

$routes->get('admin/section-variations', 'Admin\SectionVariation::index');

$routes->get('admin/template-section-variations', 'Admin\TemplateSectionVariation::index');

$routes->get('admin/site-sections', 'Admin\SiteSection::index');

$routes->get('admin/design-settings', 'Admin\SiteDesignSetting::index');

$routes->get('admin/media', 'Admin\SiteMedia::index');

$routes->get('admin/media/upload', 'Admin\SiteMedia::create');

$routes->post('admin/media/upload', 'Admin\SiteMedia::upload');

$routes->get('admin/media/view/(:num)', 'Admin\SiteMedia::view/$1');
