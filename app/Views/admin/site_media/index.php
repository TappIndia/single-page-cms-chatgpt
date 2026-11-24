<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Website Media</h2>
    <span class="badge bg-primary">
        Total Files: <?= count($media) ?>
    </span>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>File Name</th>
                        <th>File Type</th>
                        <th>MIME Type</th>
                        <th>Size</th>
                        <th>Alt Text</th>
                        <th>Status</th>
                        <th>Uploaded</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($media)): ?>
                        <?php foreach ($media as $item): ?>
                            <tr>
                                <td><?= esc($item['id']) ?></td>
                                <td><?= esc($item['site_name']) ?></td>
                                <td>
                                    <strong><?= esc($item['original_name']) ?></strong>
                                    <br>
                                    <small class="text-muted">
                                        <?= esc($item['file_name']) ?>
                                    </small>
                                </td>
                                <td><?= esc($item['file_type']) ?></td>
                                <td><?= esc($item['mime_type'] ?? '-') ?></td>
                                <td>
                                    <?= number_format($item['file_size'] / 1024, 2) ?> KB
                                </td>
                                <td><?= esc($item['alt_text'] ?? '-') ?></td>
                                <td>
                                    <span class="badge bg-<?= $item['status'] === 'active' ? 'success' : 'secondary' ?>">
                                        <?= esc($item['status']) ?>
                                    </span>
                                </td>
                                <td><?= esc($item['created_at'] ?? '-') ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">
                                No media records found.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
