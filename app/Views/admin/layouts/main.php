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
            padding: 13px 20px;
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

        .sidebar a.disabled {
            color: #777;
            cursor: not-allowed;
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

                <a href="<?= site_url('admin') ?>"
                   class="<?= uri_string() === 'admin' ? 'active' : '' ?>">
                    Dashboard
                </a>

                <a href="<?= site_url('admin/websites') ?>"
                   class="<?= uri_string() === 'admin/websites' ? 'active' : '' ?>">
                    Websites
                </a>

                <a href="<?= site_url('admin/templates') ?>" class="<?= uri_string() === 'admin/templates' ? 'active' : '' ?>">Templates</a>
                <a href="<?= site_url('admin/section-types') ?>" class="<?= uri_string() === 'admin/section-types' ? 'active' : '' ?>">Sections</a>
                <a href="<?= site_url('admin/section-variations') ?>" class="<?= uri_string() === 'admin/section-variations' ? 'active' : '' ?>">Section Variations</a>
                <a href="#" class="disabled">Media</a>
                <a href="#" class="disabled">Settings</a>

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



