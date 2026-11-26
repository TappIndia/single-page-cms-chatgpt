<?php
$title = $content['title'] ?? 'Our Gallery';
$images = $content['images'] ?? [];
?>

<section class="site-section gallery-grid">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="gallery-grid-list">
            <?php foreach ($images as $image): ?>
                <?php
                $imagePath = is_array($image)
                    ? ($image['image'] ?? $image['url'] ?? '')
                    : $image;

                $imageAlt = is_array($image)
                    ? ($image['alt'] ?? $title)
                    : $title;
                ?>

                <?php if ($imagePath): ?>
                    <div class="gallery-grid-item">
                        <img
                            src="<?= esc(base_url($imagePath)) ?>"
                            alt="<?= esc($imageAlt) ?>"
                            loading="lazy"
                        >
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .gallery-grid h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .gallery-grid-list {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 20px;
    }

    .gallery-grid-item {
        overflow: hidden;
        border-radius: 12px;
    }

    .gallery-grid-item img {
        display: block;
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform .3s ease;
    }

    .gallery-grid-item:hover img {
        transform: scale(1.05);
    }

    @media (max-width: 768px) {
        .gallery-grid-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .gallery-grid-list {
            grid-template-columns: 1fr;
        }
    }
</style>