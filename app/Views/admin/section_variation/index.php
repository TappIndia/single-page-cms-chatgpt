<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Section Variations</h2>
    <button class="btn btn-primary" disabled>Add Variation</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Section Type</th>
                        <th>Variation Name</th>
                        <th>Variation Key</th>
                        <th>View File</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($variations)): ?>
                        <?php foreach ($variations as $variation): ?>
                            <tr>
                                <td><?= esc($variation['id']) ?></td>
                                <td><?= esc($variation['type_name']) ?></td>
                                <td><?= esc($variation['variation_name']) ?></td>
                                <td><?= esc($variation['variation_key']) ?></td>
                                <td><?= esc($variation['view_file']) ?></td>
                                <td>
                                    <?php if ($variation['is_active']): ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Inactive</span>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No variations found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
