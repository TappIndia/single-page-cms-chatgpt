<?php
$title = $content['title'] ?? 'Our Services';
$services = $content['items'] ?? [];
?>

<section class="site-section services-list">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="services-list-items">
            <?php foreach ($services as $service): ?>
                <article class="service-list-item">
                    <h3><?= esc($service['title'] ?? '') ?></h3>
                    <p><?= esc($service['description'] ?? '') ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .services-list h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .services-list-items {
        display: grid;
        gap: 20px;
    }

    .service-list-item {
        padding: 25px 30px;
        border-left: 4px solid var(--primary);
        background: #f5f5f5;
        border-radius: 8px;
    }

    .service-list-item h3 {
        color: var(--primary);
        font-size: 22px;
        margin: 0 0 10px;
    }

    .service-list-item p {
        margin: 0;
        line-height: 1.7;
    }
</style>