<?php
$title = $content['title'] ?? 'Our Services';
$items = $content['items'] ?? [];
?>

<section class="site-section services-grid-4">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="services-grid">
            <?php foreach ($items as $item): ?>
                <article class="service-card">
                    <?php if (!empty($item['icon'])): ?>
                        <div class="service-icon">
                            <?= esc($item['icon']) ?>
                        </div>
                    <?php endif; ?>

                    <h3><?= esc($item['title'] ?? '') ?></h3>

                    <p><?= esc($item['description'] ?? '') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .services-grid-4 h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .services-grid-4 .services-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 24px;
    }

    .services-grid-4 .service-card {
        padding: 28px 20px;
        background: #f5f5f5;
        border-radius: 12px;
        text-align: center;
    }

    .services-grid-4 .service-icon {
        font-size: 36px;
        margin-bottom: 15px;
    }

    .services-grid-4 .service-card h3 {
        font-size: 19px;
        margin-bottom: 12px;
    }

    .services-grid-4 .service-card p {
        color: #666;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 992px) {
        .services-grid-4 .services-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .services-grid-4 .services-grid {
            grid-template-columns: 1fr;
        }
    }
</style>