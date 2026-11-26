<?php
$title = $content['title'] ?? 'Frequently Asked Questions';
$items = $content['items'] ?? [];
?>

<section class="site-section faq-accordion">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="faq-list">
            <?php foreach ($items as $index => $item): ?>
                <details class="faq-item" <?= $index === 0 ? 'open' : '' ?>>
                    <summary><?= esc($item['question'] ?? '') ?></summary>
                    <div class="faq-answer">
                        <?= esc($item['answer'] ?? '') ?>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .faq-accordion h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 35px;
    }

    .faq-list {
        max-width: 850px;
        margin: 0 auto;
    }

    .faq-item {
        background: #f7f7f7;
        border-radius: 8px;
        margin-bottom: 14px;
        padding: 18px 22px;
    }

    .faq-item summary {
        cursor: pointer;
        font-weight: 600;
        font-size: 17px;
    }

    .faq-answer {
        padding-top: 15px;
        line-height: 1.7;
        color: #555;
    }
</style>