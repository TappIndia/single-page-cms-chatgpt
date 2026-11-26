<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="mb-1">Contact Submissions</h3>
    <p class="text-muted mb-0">View messages submitted through your website contact forms.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>Page</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Submitted</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($submissions)): ?>
                        <?php foreach ($submissions as $submission): ?>
                            <tr>
                                <td><?= esc($submission['id']) ?></td>
                                <td><?= esc($submission['site_name']) ?></td>
                                <td><?= esc($submission['page_title'] ?? '-') ?></td>
                                <td><?= esc($submission['name']) ?></td>
                                <td>
                                    <a href="mailto:<?= esc($submission['email']) ?>">
                                        <?= esc($submission['email']) ?>
                                    </a>
                                </td>
                                <td><?= esc($submission['phone'] ?: '-') ?></td>
                                <td><?= esc($submission['subject'] ?: '-') ?></td>
                                <td>
                                    <form action="<?= site_url('admin/contact-submissions/update-status/' . $submission['id']) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                            <?php foreach (['new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'closed' => 'Closed'] as $value => $label): ?>
                                                <option value="<?= esc($value) ?>" <?= $submission['status'] === $value ? 'selected' : '' ?>>
                                                    <?= esc($label) ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </form>
                                </td>
                                <td><?= esc($submission['created_at']) ?></td>
                            </tr>
                            <tr class="table-light">
                                <td colspan="9">
                                    <strong>Message:</strong>
                                    <?= nl2br(esc($submission['message'])) ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                No contact submissions found.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

