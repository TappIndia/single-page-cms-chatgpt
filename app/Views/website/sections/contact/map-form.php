<?php
$title = $content['title'] ?? 'Get In Touch';
$description = $content['description'] ?? '';
$email = $content['email'] ?? '';
$phone = $content['phone'] ?? '';
$address = $content['address'] ?? '';
$mapUrl = $content['map_url'] ?? '';
?>

<section class="site-section contact-map-form">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <?php if ($description): ?>
            <p class="contact-map-description"><?= esc($description) ?></p>
        <?php endif; ?>

        <div class="contact-map-layout">
            <div class="contact-map-details">
                <?php if ($address): ?>
                    <p><strong>Address:</strong> <?= esc($address) ?></p>
                <?php endif; ?>

                <?php if ($phone): ?>
                    <p><strong>Phone:</strong> <?= esc($phone) ?></p>
                <?php endif; ?>

                <?php if ($email): ?>
                    <p><strong>Email:</strong> <?= esc($email) ?></p>
                <?php endif; ?>

                <?php if ($mapUrl): ?>
                    <iframe
                        src="<?= esc($mapUrl) ?>"
                        width="100%"
                        height="280"
                        style="border:0;"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Location map"
                    ></iframe>
                <?php endif; ?>
            </div>

            <?php if (session()->getFlashdata('success')): ?>
    <div style="padding:12px 16px;margin-bottom:15px;background:#d1e7dd;color:#0f5132;border-radius:6px;">
        <?= esc(session()->getFlashdata('success')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div style="padding:12px 16px;margin-bottom:15px;background:#f8d7da;color:#842029;border-radius:6px;">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div style="padding:12px 16px;margin-bottom:15px;background:#fff3cd;color:#664d03;border-radius:6px;">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <p><?= esc($error) ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<form class="contact-map-form-fields" action="<?= site_url('contact/submit') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="page_id" value="<?= esc($page['id']) ?>">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="phone" placeholder="Your Phone">
                <input type="text" name="subject" placeholder="Subject">
                <textarea name="message" rows="6" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</section>

<style>
    .contact-map-form h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 15px;
    }

    .contact-map-description {
        text-align: center;
        margin-bottom: 35px;
    }

    .contact-map-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }

    .contact-map-details,
    .contact-map-form-fields {
        padding: 25px;
        background: #f5f5f5;
        border-radius: 12px;
    }

    .contact-map-details p {
        line-height: 1.7;
        margin-bottom: 15px;
    }

    .contact-map-details iframe {
        border-radius: 8px;
        margin-top: 10px;
    }

    .contact-map-form-fields {
        display: grid;
        gap: 15px;
    }

    .contact-map-form-fields input,
    .contact-map-form-fields textarea {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font: inherit;
    }

    .contact-map-form-fields button {
        padding: 13px 22px;
        background: var(--primary);
        color: #fff;
        border: 0;
        border-radius: 6px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .contact-map-layout {
            grid-template-columns: 1fr;
        }
    }
</style>