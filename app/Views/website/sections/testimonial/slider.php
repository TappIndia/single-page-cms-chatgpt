<?php
$title = $content['title'] ?? 'Testimonials';
$testimonials = $content['items'] ?? [];
$sliderId = 'testimonial-slider-' . uniqid();
?>

<section class="site-section testimonial-slider">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <?php if (!empty($testimonials)): ?>
            <div class="testimonial-slider-container" id="<?= esc($sliderId) ?>">
                <?php foreach ($testimonials as $index => $testimonial): ?>
                    <article class="testimonial-slide <?= $index === 0 ? 'active' : '' ?>">
                        <p class="testimonial-message">
                            "<?= esc($testimonial['message'] ?? '') ?>"
                        </p>

                        <h3><?= esc($testimonial['name'] ?? '') ?></h3>

                        <span>
                            <?= esc($testimonial['designation'] ?? '') ?>
                        </span>
                    </article>
                <?php endforeach; ?>

                <?php if (count($testimonials) > 1): ?>
                    <div class="testimonial-slider-controls">
                        <button type="button" data-direction="previous">Previous</button>
                        <button type="button" data-direction="next">Next</button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<style>
    .testimonial-slider h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .testimonial-slider-container {
        max-width: 750px;
        margin: auto;
        text-align: center;
    }

    .testimonial-slide {
        display: none;
        padding: 35px;
        background: #f5f5f5;
        border-radius: 12px;
    }

    .testimonial-slide.active {
        display: block;
    }

    .testimonial-message {
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 25px;
    }

    .testimonial-slide h3 {
        margin: 0 0 5px;
        font-size: 20px;
    }

    .testimonial-slide span {
        color: #777;
        font-size: 14px;
    }

    .testimonial-slider-controls {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }

    .testimonial-slider-controls button {
        padding: 10px 22px;
        border: 0;
        border-radius: 6px;
        background: var(--primary);
        color: #fff;
        cursor: pointer;
    }
</style>

<script>
(function () {
    const container = document.getElementById(<?= json_encode($sliderId) ?>);

    if (!container) return;

    const slides = container.querySelectorAll('.testimonial-slide');
    const buttons = container.querySelectorAll('[data-direction]');
    let currentIndex = 0;

    function showSlide(index) {
        slides[currentIndex].classList.remove('active');
        currentIndex = (index + slides.length) % slides.length;
        slides[currentIndex].classList.add('active');
    }

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const direction = this.dataset.direction;
            showSlide(currentIndex + (direction === 'next' ? 1 : -1));
        });
    });
})();
</script>