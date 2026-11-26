<?php
$title = $content['title'] ?? 'What Our Clients Say';
$testimonials = $content['items'] ?? [];
?>

<section class="site-section testimonial-cards">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="testimonial-cards-grid">
            <?php foreach ($testimonials as $testimonial): ?>
                <article class="testimonial-card">
                    <p class="testimonial-message">
                        "<?= esc($testimonial['message'] ?? '') ?>"
                    </p>

                    <div class="testimonial-author">
                        <h3><?= esc($testimonial['name'] ?? '') ?></h3>
                        <span><?= esc($testimonial['designation'] ?? '') ?></span>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .testimonial-cards h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .testimonial-cards-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 25px;
    }

    .testimonial-card {
        padding: 30px;
        background: #f5f5f5;
        border-radius: 12px;
        border-top: 4px solid var(--primary);
    }

    .testimonial-message {
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .testimonial-author h3 {
        font-size: 18px;
        margin: 0 0 5px;
    }

    .testimonial-author span {
        color: #777;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .testimonial-cards-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .testimonial-cards-grid {
            grid-template-columns: 1fr;
        }
    }
</style>