<?php
$title = $content['title'] ?? '';
$subtitle = $content['subtitle'] ?? '';
$buttonText = $content['button_text'] ?? '';
$image = $content['image'] ?? '';

$imageUrl = '';

if ($image !== '') {
    $imageUrl = base_url(
        'uploads/sites/' . (int) $site['id'] . '/' . rawurlencode(basename($image))
    );
}

$imagePosition = $layout['image_position'] ?? 'right';
$reverse = $imagePosition === 'left';
?>

<section class="site-section hero-split">
    <div class="container">
        <div class="hero-split-grid <?= $reverse ? 'image-left' : 'image-right' ?>">
            <div class="hero-split-content">
                <?php if ($title !== ''): ?>
                    <h1><?= esc($title) ?></h1>
                <?php endif; ?>

                <?php if ($subtitle !== ''): ?>
                    <p><?= esc($subtitle) ?></p>
                <?php endif; ?>

                <?php if ($buttonText !== ''): ?>
                    <a class="hero-split-button" href="<?= base_url('services') ?>">
                        <?= esc($buttonText) ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ($imageUrl !== ''): ?>
                <div class="hero-split-image">
                    <img src="<?= esc($imageUrl) ?>" alt="<?= esc($title) ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
    .hero-split-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 45px;
    }

    .hero-split-grid.image-left .hero-split-content {
        order: 2;
    }

    .hero-split-grid.image-left .hero-split-image {
        order: 1;
    }

    .hero-split-content h1 {
        font-size: clamp(32px, 5vw, 52px);
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 20px;
    }

    .hero-split-content p {
        font-size: 18px;
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .hero-split-button {
        display: inline-block;
        padding: 13px 26px;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
    }

    .hero-split-image img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 12px;
    }

    @media (max-width: 768px) {
        .hero-split-grid {
            grid-template-columns: 1fr;
        }

        .hero-split-grid.image-left .hero-split-content,
        .hero-split-grid.image-left .hero-split-image {
            order: initial;
        }

        .hero-split-image img {
            height: 260px;
        }
    }
</style>