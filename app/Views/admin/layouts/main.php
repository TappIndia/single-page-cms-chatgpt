<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'CMS Admin') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
            margin: 0;
        }

        .navbar {
            min-height: 60px;
        }

        .sidebar {
            min-height: calc(100vh - 60px);
            background: #212529;
        }

        .sidebar a {
            display: block;
            color: #ced4da;
            padding: 12px 20px;
            text-decoration: none;
            transition: 0.2s;
        }

        .sidebar a:hover {
            background: #343a40;
            color: white;
        }

        .sidebar a.active {
            background: #0d6efd;
            color: white;
        }

        .sidebar-heading {
            color: #8d969e;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 18px 20px 6px;
        }

        .main-content {
            padding: 30px;
            min-height: calc(100vh - 110px);
        }

        footer {
            background: white;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand fw-bold" href="<?= site_url('admin') ?>">
        Single Page CMS
    </a>
    <span class="text-white">Administrator</span>
</nav>

<div class="container-fluid">
    <div class="row">

        <aside class="col-md-2 sidebar p-0">
            <div class="py-3">

                <div class="sidebar-heading">Main</div>

                <a href="<?= site_url('admin') ?>"
                   class="<?= uri_string() === 'admin' ? 'active' : '' ?>">
                    Dashboard
                </a>

                <a href="<?= site_url('admin/websites') ?>"
                   class="<?= url_is('admin/websites*') ? 'active' : '' ?>">
                    Websites
                </a>

                <div class="sidebar-heading">Templates</div>

                <a href="<?= site_url('admin/templates') ?>"
                   class="<?= url_is('admin/templates*') ? 'active' : '' ?>">
                    Templates
                </a>

                <a href="<?= site_url('admin/section-types') ?>"
                   class="<?= url_is('admin/section-types*') ? 'active' : '' ?>">
                    Section Types
                </a>

                <a href="<?= site_url('admin/section-variations') ?>"
                   class="<?= url_is('admin/section-variations*') ? 'active' : '' ?>">
                    Section Variations
                </a>

                <a href="<?= site_url('admin/template-section-variations') ?>"
                   class="<?= url_is('admin/template-section-variations*') ? 'active' : '' ?>">
                    Template Section Variations
                </a>

                <div class="sidebar-heading">Website Content</div>

                <a href="<?= site_url('admin/site-sections') ?>"
                   class="<?= url_is('admin/site-sections*') ? 'active' : '' ?>">
                    Website Sections
                </a>

                <a href="<?= site_url('admin/pages') ?>"
                   class="<?= url_is('admin/pages*') ? 'active' : '' ?>">
                    Pages
                </a>

                <a href="<?= site_url('admin/page-sections') ?>"
                   class="<?= url_is('admin/page-sections*') ? 'active' : '' ?>">
                    Page Sections
                </a>

                <div class="sidebar-heading">Website Settings</div>

                <a href="<?= site_url('admin/design-settings') ?>"
                   class="<?= url_is('admin/design-settings*') ? 'active' : '' ?>">
                    Design Settings
                </a>

                <a href="<?= site_url('admin/media') ?>"
                   class="<?= url_is('admin/media*') ? 'active' : '' ?>">
                    Media
                </a>

                <a href="<?= site_url('admin/domains') ?>"
                   class="<?= url_is('admin/domains*') ? 'active' : '' ?>">
                    Domains
                </a>

                <a href="#" class="disabled">
                    Settings
                </a>

            </div>
        </aside>

        <main class="col-md-10 main-content">
            <?= $this->renderSection('content') ?>
        </main>

    </div>
</div>

<footer class="text-center py-3 text-muted">
    Single Page CMS &copy; <?= date('Y') ?>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>