<?php
$title = $content['title'] ?? 'Our Team';
$members = $content['members'] ?? [];
$columns = max(1, min(4, (int) ($layout['columns'] ?? 3)));
?>

<section class="site-section team-grid">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <div class="team-grid-list" style="--columns: <?= $columns ?>;">
            <?php foreach ($members as $member): ?>
                <article class="team-card">
                    <?php if (!empty($member['image'])): ?>
                        <img
                            src="<?= esc(base_url($member['image'])) ?>"
                            alt="<?= esc($member['name'] ?? 'Team member') ?>"
                            loading="lazy"
                        >
                    <?php endif; ?>

                    <div class="team-card-content">
                        <h3><?= esc($member['name'] ?? '') ?></h3>

                        <span><?= esc($member['designation'] ?? '') ?></span>

                        <?php if (!empty($member['description'])): ?>
                            <p><?= esc($member['description']) ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<style>
    .team-grid h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 40px;
    }

    .team-grid-list {
        display: grid;
        grid-template-columns: repeat(var(--columns), minmax(0, 1fr));
        gap: 25px;
    }

    .team-card {
        overflow: hidden;
        background: #f5f5f5;
        border-radius: 12px;
        text-align: center;
    }

    .team-card > img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
    }

    .team-card-content {
        padding: 22px;
    }

    .team-card h3 {
        font-size: 20px;
        margin: 0 0 7px;
    }

    .team-card span {
        color: var(--primary);
        font-size: 14px;
        font-weight: 600;
    }

    .team-card p {
        margin: 12px 0 0;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .team-grid-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 520px) {
        .team-grid-list {
            grid-template-columns: 1fr;
        }
    }
</style>