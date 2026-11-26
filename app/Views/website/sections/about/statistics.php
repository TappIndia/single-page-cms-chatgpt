<?php
$title = $content['title'] ?? 'Our Achievements';
$statistics = $content['statistics'] ?? [];
$columns = max(1, min(4, (int) ($layout['columns'] ?? 3)));
?>

<section class="site-section about-statistics">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="statistics-grid" style="--columns: <?= $columns ?>;">
            <?php foreach ($statistics as $statistic): ?>
                <div class="statistic-card">
                    <h3><?= esc($statistic['value'] ?? '') ?></h3>
                    <p><?= esc($statistic['label'] ?? '') ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .about-statistics h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .statistics-grid {
        display: grid;
        grid-template-columns: repeat(var(--columns), minmax(0, 1fr));
        gap: 25px;
    }

    .statistic-card {
        padding: 35px 20px;
        text-align: center;
        background: #f5f5f5;
        border-radius: 12px;
    }

    .statistic-card h3 {
        color: var(--primary);
        font-size: 38px;
        margin: 0 0 10px;
    }

    .statistic-card p {
        margin: 0;
        font-size: 16px;
    }

    @media (max-width: 600px) {
        .statistics-grid {
            grid-template-columns: 1fr;
        }
    }
</style>