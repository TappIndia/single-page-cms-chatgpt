<?php
$title = $content['title'] ?? 'Build Your Future';
$subtitle = $content['subtitle'] ?? '';
$buttonText = $content['button_text'] ?? '';
$buttonUrl = $content['button_url'] ?? '#';
$backgroundImage = $content['background_image'] ?? '';
$showOverlay = $layout['overlay'] ?? true;
?>

<section
    class="hero-banner"
    <?php if ($backgroundImage): ?>
        style="background-image: url('<?= esc(base_url($backgroundImage)) ?>');"
    <?php endif; ?>
>
    <?php if ($showOverlay): ?>
        <div class="hero-banner-overlay"></div>
    <?php endif; ?>

    <div class="hero-banner-content">
        <h1><?= esc($title) ?></h1>

        <?php if ($subtitle): ?>
            <p><?= esc($subtitle) ?></p>
        <?php endif; ?>

        <?php if ($buttonText): ?>
            <a href="<?= esc($buttonUrl) ?>" class="hero-banner-button">
                <?= esc($buttonText) ?>
            </a>
        <?php endif; ?>
    </div>
</section>

<style>
    .hero-banner {
        position: relative;
        min-height: 480px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 80px 25px;
        text-align: center;
        color: #fff;
        background-color: #333;
        background-position: center;
        background-size: cover;
    }

    .hero-banner-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
    }

    .hero-banner-content {
        position: relative;
        z-index: 1;
        max-width: 850px;
    }

    .hero-banner h1 {
        font-size: clamp(36px, 6vw, 60px);
        font-weight: 700;
        margin-bottom: 20px;
    }

    .hero-banner p {
        font-size: 19px;
        line-height: 1.7;
        margin-bottom: 25px;
    }

    .hero-banner-button {
        display: inline-block;
        padding: 13px 28px;
        background: var(--primary);
        color: #fff;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
    }

    .hero-banner-button:hover {
        opacity: 0.9;
        color: #fff;
    }

    @media (max-width: 576px) {
        .hero-banner {
            min-height: 380px;
        }
    }
</style>