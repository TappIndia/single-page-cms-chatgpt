<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Website Section Management</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>Section Name</th>
                        <th>Section Key</th>
                        <th>Section Type</th>
                        <th>Variation</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Sync</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($sections)): ?>
                        <?php foreach ($sections as $section): ?>
                            <tr>
                                <td><?= esc($section['id']) ?></td>
                                <td><?= esc($section['site_name']) ?></td>
                                <td><?= esc($section['section_name']) ?></td>
                                <td><?= esc($section['section_key']) ?></td>
                                <td><?= esc($section['section_type']) ?></td>
                                <td><?= esc($section['view_key']) ?></td>
                                <td><?= esc($section['sort_order']) ?></td>
                                <td>
                                    <?php if ($section['is_enabled']): ?>
                                        <span class="badge bg-success">Enabled</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Disabled</span>
                                    <?php endif ?>
                                </td>
                                <td><?= esc($section['sync_status']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">
                                No website sections found.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
