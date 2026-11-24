<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Website Domains</h3>
        <p class="text-muted mb-0">Manage domains connected to your websites.</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>Domain</th>
                        <th>Primary</th>
                        <th>Verified</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($domains)): ?>
                        <?php foreach ($domains as $item): ?>
                            <tr>
                                <td><?= esc($item['id']) ?></td>
                                <td><?= esc($item['site_name']) ?></td>
                                <td><?= esc($item['domain']) ?></td>
                                <td>
                                    <?= $item['is_primary']
                                        ? '<span class="badge bg-primary">Primary</span>'
                                        : '<span class="text-muted">No</span>' ?>
                                </td>
                                <td>
                                    <?= $item['is_verified']
                                        ? '<span class="badge bg-success">Verified</span>'
                                        : '<span class="badge bg-warning text-dark">Pending</span>' ?>
                                </td>
                                <td><?= esc(ucfirst($item['status'])) ?></td>
                                <td><?= esc($item['created_at']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                No domains found.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
