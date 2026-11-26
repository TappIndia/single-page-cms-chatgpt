<?php
$links = $content['links'] ?? [];
$copyright = $content['copyright'] ?? 'All rights reserved';
?>

<footer class="site-footer">
    <div class="container">
        <?php if (!empty($links)): ?>
            <nav class="footer-links">
                <?php foreach ($links as $link): ?>
                    <a href="<?= esc($link['url'] ?? '#') ?>">
                        <?= esc($link['label'] ?? '') ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <p class="footer-copyright">
            &copy; <?= date('Y') ?> <?= esc($copyright) ?>
        </p>
    </div>
</footer>

<style>
    .site-footer {
        background: #222;
        color: #fff;
        padding: 35px 20px;
        text-align: center;
    }

    .footer-links {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 25px;
        margin-bottom: 20px;
    }

    .footer-links a {
        color: #fff;
        text-decoration: none;
    }

    .footer-links a:hover {
        color: var(--primary);
    }

    .footer-copyright {
        margin: 0;
        color: #ccc;
        font-size: 14px;
    }
</style>