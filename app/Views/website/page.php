<?php
$primaryColor = $design['color.primary'] ?? '#0d6efd';
$secondaryColor = $design['color.secondary'] ?? '#222222';
$backgroundColor = $design['color.background'] ?? '#ffffff';
$bodyFont = $design['font.body.family'] ?? 'Arial';
$headingFont = $design['font.heading.family'] ?? 'Arial';

$siteSettings = json_decode($site['settings_json'] ?? '{}', true) ?: [];
$language = $siteSettings['language'] ?? 'en';
?>
<!DOCTYPE html>
<html lang="<?= esc($language) ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($page['meta_title'] ?: $page['title'] . ' - ' . $site['name']) ?></title>

    <?php if (!empty($page['meta_description'])): ?>
        <meta name="description" content="<?= esc($page['meta_description']) ?>">
    <?php endif; ?>

    <style>
        :root {
            --primary: <?= esc($primaryColor) ?>;
            --secondary: <?= esc($secondaryColor) ?>;
            --background: <?= esc($backgroundColor) ?>;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            color: var(--secondary);
            background: var(--background);
            font-family: <?= esc($bodyFont) ?>, sans-serif;
        }

        h1, h2, h3 {
            font-family: <?= esc($headingFont) ?>, sans-serif;
        }

        .site-header {
            padding: 22px 6%;
            border-bottom: 1px solid #eee;
        }

        .site-header a {
            color: var(--secondary);
            text-decoration: none;
            margin-right: 22px;
        }

        .site-name {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary) !important;
        }

        .site-section { padding: 65px 6%; }

        .container {
            max-width: 1140px;
            margin: auto;
        }

        .site-footer {
            padding: 30px 6%;
            text-align: center;
            background: var(--secondary);
            color: white;
        }
    </style>
</head>
<body>

<header class="site-header">
    <a class="site-name" href="<?= base_url() ?>"><?= esc($site['name']) ?></a>

    <?php
    $navigationPages = db_connect()->table('site_page')
        ->where('site_id', $site['id'])
        ->where('is_enabled', 1)
        ->where('status', 'published')
        ->orderBy('sort_order', 'ASC')
        ->get()
        ->getResultArray();
    ?>

    <?php foreach ($navigationPages as $navigationPage): ?>
        <a href="<?= $navigationPage['is_homepage'] ? base_url() : base_url($navigationPage['slug']) ?>">
            <?= esc($navigationPage['title']) ?>
        </a>
    <?php endforeach; ?>
</header>

<main>
    <?php foreach ($sections as $section): ?>
        <?php
        $content = json_decode($section['content_json'] ?? '{}', true) ?: [];
        $layout = json_decode($section['layout_json'] ?? '{}', true) ?: [];

        $viewFile = $section['variation_view_file'] ?? null;
        $viewPath = null;

        if (
            is_string($viewFile)
            && preg_match('#^[a-zA-Z0-9_-]+/[a-zA-Z0-9_-]+\.php$#', $viewFile)
        ) {
            $candidate = APPPATH . 'Views/website/sections/' . $viewFile;

            if (is_file($candidate)) {
                $viewPath = 'website/sections/' . substr($viewFile, 0, -4);
            }
        }
        ?>

        <?php if ($viewPath !== null): ?>
            <?= view($viewPath, [
                'site' => $site,
                'page' => $page,
                'section' => $section,
                'content' => $content,
                'layout' => $layout,
                'design' => $design,
            ]) ?>
        <?php else: ?>
            <section class="site-section">
                <div class="container">
                    <h2><?= esc($content['title'] ?? $section['section_name']) ?></h2>
                    <?php if (!empty($content['description'])): ?>
                        <p><?= esc($content['description']) ?></p>
                    <?php endif; ?>
                    <p><small>Section variation view is not available.</small></p>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>
</main>

<footer class="site-footer">
    &copy; <?= date('Y') ?> <?= esc($site['name']) ?>. All rights reserved.
</footer>

</body>
</html>