<?php
$title = $content['title'] ?? '';
$subtitle = $content['subtitle'] ?? '';
$alignment = $layout['alignment'] ?? 'center';
$height = $layout['height'] ?? 'medium';
?>

<section class="site-section hero-centered hero-height-<?= esc($height) ?>">
    <div class="container" style="text-align: <?= esc($alignment === 'left' ? 'left' : 'center') ?>;">
        <?php if ($title !== ''): ?>
            <h1><?= esc($title) ?></h1>
        <?php endif; ?>

        <?php if ($subtitle !== ''): ?>
            <p><?= esc($subtitle) ?></p>
        <?php endif; ?>
    </div>
</section>

<style>
    .hero-centered {
        display: flex;
        align-items: center;
        background: #f5f5f5;
    }

    .hero-height-small { min-height: 220px; }
    .hero-height-medium { min-height: 320px; }
    .hero-height-large { min-height: 420px; }

    .hero-centered h1 {
        font-size: clamp(32px, 5vw, 52px);
        font-weight: 700;
        margin-bottom: 18px;
    }

    .hero-centered p {
        font-size: 18px;
        line-height: 1.7;
    }
</style>