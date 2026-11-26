<?php
$title = $content['title'] ?? '';
$description = $content['description'] ?? '';
$image = $content['image'] ?? '';

$imageUrl = '';

if ($image !== '') {
    $imageUrl = base_url(
        'uploads/sites/' . (int) $site['id'] . '/' . rawurlencode(basename($image))
    );
}
?>

<section class="site-section about-image-left">
    <div class="container">
        <div class="about-image-left-grid">
            <?php if ($imageUrl !== ''): ?>
                <div class="about-image">
                    <img src="<?= esc($imageUrl) ?>" alt="<?= esc($title) ?>">
                </div>
            <?php endif; ?>

            <div class="about-content">
                <?php if ($title !== ''): ?>
                    <h2><?= esc($title) ?></h2>
                <?php endif; ?>

                <?php if ($description !== ''): ?>
                    <p><?= esc($description) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<style>
    .about-image-left-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 45px;
    }

    .about-image img {
        display: block;
        width: 100%;
        height: 360px;
        object-fit: cover;
        border-radius: 12px;
    }

    .about-content h2 {
        color: var(--primary);
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 20px;
    }

    .about-content p {
        font-size: 17px;
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .about-image-left-grid {
            grid-template-columns: 1fr;
        }

        .about-image img {
            height: 260px;
        }
    }
</style>