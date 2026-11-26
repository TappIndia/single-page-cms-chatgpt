<?php
$title = $content['title'] ?? 'Contact Us';
$description = $content['description'] ?? '';
$email = $content['email'] ?? '';
$phone = $content['phone'] ?? '';
$address = $content['address'] ?? '';
?>

<section class="site-section contact-simple">
    <div class="container">
        <h2><?= esc($title) ?></h2>

        <?php if ($description): ?>
            <p class="contact-description"><?= esc($description) ?></p>
        <?php endif; ?>

        <div class="contact-simple-layout">
            <div class="contact-details">
                <?php if ($email): ?>
                    <p><strong>Email:</strong> <?= esc($email) ?></p>
                <?php endif; ?>

                <?php if ($phone): ?>
                    <p><strong>Phone:</strong> <?= esc($phone) ?></p>
                <?php endif; ?>

                <?php if ($address): ?>
                    <p><strong>Address:</strong> <?= esc($address) ?></p>
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
<form class="contact-form" action="<?= site_url('contact/submit') ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="page_id" value="<?= esc($page['id']) ?>">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="phone" placeholder="Your Phone">
                <input type="text" name="subject" placeholder="Subject">
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
</section>

<style>
    .contact-simple h2 {
        text-align: center;
        font-size: clamp(28px, 4vw, 40px);
        margin-bottom: 20px;
    }

    .contact-description {
        text-align: center;
        margin-bottom: 35px;
    }

    .contact-simple-layout {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 35px;
    }

    .contact-details,
    .contact-form {
        padding: 30px;
        background: #f5f5f5;
        border-radius: 12px;
    }

    .contact-details p {
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .contact-form {
        display: grid;
        gap: 15px;
    }

    .contact-form input,
    .contact-form textarea {
        width: 100%;
        padding: 13px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font: inherit;
    }

    .contact-form button {
        padding: 13px 22px;
        background: var(--primary);
        color: #fff;
        border: 0;
        border-radius: 6px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .contact-simple-layout {
            grid-template-columns: 1fr;
        }
    }
</style>