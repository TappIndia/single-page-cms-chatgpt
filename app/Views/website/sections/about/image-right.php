<?php
$title = $content['title'] ?? 'About Us';
$description = $content['description'] ?? '';
$image = $content['image'] ?? '';
$imageUrl = $image ? base_url($image) : '';
?>

<section class="site-section about-image-right">
    <div class="container about-image-right-layout">
        <div class="about-image-right-content">
            <h2><?= esc($title) ?></h2>
            <p><?= esc($description) ?></p>
        </div>

        <?php if ($imageUrl): ?>
            <div class="about-image-right-image">
                <img src="<?= esc($imageUrl) ?>" alt="<?= esc($title) ?>">
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .about-image-right-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 45px;
    }

    .about-image-right-content h2 {
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 20px;
    }

    .about-image-right-content p {
        line-height: 1.8;
    }

    .about-image-right-image img {
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 12px;
    }

    @media (max-width: 768px) {
        .about-image-right-layout {
            grid-template-columns: 1fr;
        }
    }
</style>