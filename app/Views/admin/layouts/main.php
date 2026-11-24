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
        }

        .sidebar {
            min-height: calc(100vh - 56px);
            background: #212529;
        }

        .sidebar a {
            display: block;
            color: #ced4da;
            padding: 12px 18px;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #343a40;
            color: #fff;
        }

        .main-content {
            padding: 25px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="<?= site_url('admin') ?>">
        Single Page CMS
    </a>
    <span class="text-white">Administrator</span>
</nav>

<div class="container-fluid">
    <div class="row">

        <aside class="col-md-2 sidebar p-0">
            <div class="py-3">
                <a href="<?= site_url('admin') ?>" class="active">Dashboard</a>
                <a href="#">Websites</a>
                <a href="#">Templates</a>
                <a href="#">Sections</a>
                <a href="#">Media</a>
                <a href="#">Settings</a>
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
