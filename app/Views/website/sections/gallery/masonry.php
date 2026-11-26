<?php
$title = $content['title'] ?? 'Our Gallery';
$images = $content['images'] ?? [];
?>

<section class="site-section gallery-masonry">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="gallery-masonry-list">
            <?php foreach ($images as $index => $image): ?>
                <?php
                $imagePath = is_array($image)
                    ? ($image['image'] ?? $image['url'] ?? '')
                    : $image;

                $imageAlt = is_array($image)
                    ? ($image['alt'] ?? $title)
                    : $title;
                ?>

                <?php if ($imagePath): ?>
                    <div class="gallery-masonry-item">
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
    .gallery-masonry h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .gallery-masonry-list {
        columns: 3;
        column-gap: 20px;
    }

    .gallery-masonry-item {
        break-inside: avoid;
        margin-bottom: 20px;
        overflow: hidden;
        border-radius: 12px;
    }

    .gallery-masonry-item img {
        display: block;
        width: 100%;
        height: auto;
        transition: transform .3s ease;
    }

    .gallery-masonry-item:hover img {
        transform: scale(1.04);
    }

    @media (max-width: 768px) {
        .gallery-masonry-list {
            columns: 2;
        }
    }

    @media (max-width: 520px) {
        .gallery-masonry-list {
            columns: 1;
        }
    }
</style>