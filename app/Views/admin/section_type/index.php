<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Section Type Management</h2>
    <button class="btn btn-primary" disabled>Add Section Type</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Type Name</th>
                        <th>Type Key</th>
                        <th>Description</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sectionTypes)): ?>
                        <?php foreach ($sectionTypes as $section): ?>
                            <tr>
                                <td><?= esc($section['id']) ?></td>
                                <td><?= esc($section['type_name']) ?></td>
                                <td><?= esc($section['type_key']) ?></td>
                                <td><?= esc($section['description'] ?? '') ?></td>
                                <td>
                                    <?php if ($section['is_active']): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No section types found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
