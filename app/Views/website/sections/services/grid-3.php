<?php
$title = $content['title'] ?? 'Our Services';
$services = $content['items'] ?? [];
?>

<section class="site-section services-grid">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="services-grid-list">
            <?php foreach ($services as $service): ?>
                <article class="service-card">
                    <h3><?= esc($service['title'] ?? '') ?></h3>
                    <p><?= esc($service['description'] ?? '') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .services-grid h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .services-grid-list {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 25px;
    }

    .service-card {
        padding: 30px;
        background: #f5f5f5;
        border-radius: 12px;
    }

    .service-card h3 {
        color: var(--primary);
        font-size: 22px;
        margin-bottom: 12px;
    }

    .service-card p {
        margin: 0;
        line-height: 1.7;
    }

    @media (max-width: 768px) {
        .services-grid-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .services-grid-list {
            grid-template-columns: 1fr;
        }
    }
</style>