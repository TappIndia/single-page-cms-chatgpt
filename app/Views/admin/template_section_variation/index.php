<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Template Section Variations</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Template</th>
                        <th>Section Type</th>
                        <th>Variation</th>
                        <th>Default</th>
                        <th>Enabled</th>
                        <th>Sort Order</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mappings)): ?>
                        <?php foreach ($mappings as $mapping): ?>
                            <tr>
                                <td><?= esc($mapping['id']) ?></td>
                                <td><?= esc($mapping['template_name']) ?></td>
                                <td><?= esc($mapping['section_type']) ?></td>
                                <td><?= esc($mapping['variation_name']) ?></td>
                                <td>
                                    <?= $mapping['is_default']
                                        ? '<span class="badge bg-primary">Default</span>'
                                        : '<span class="badge bg-secondary">No</span>' ?>
                                </td>
                                <td>
                                    <?= $mapping['is_enabled']
                                        ? '<span class="badge bg-success">Enabled</span>'
                                        : '<span class="badge bg-danger">Disabled</span>' ?>
                                </td>
                                <td><?= esc($mapping['sort_order']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No mappings found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
