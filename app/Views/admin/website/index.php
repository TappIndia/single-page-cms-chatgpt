<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Website Management</h2>
    <button class="btn btn-primary" disabled>Add Website</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Website Name</th>
                        <th>Slug</th>
                        <th>Template</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($websites)): ?>
                        <?php foreach ($websites as $website): ?>
                            <tr>
                                <td><?= esc($website['id']) ?></td>
                                <td><?= esc($website['name']) ?></td>
                                <td><?= esc($website['slug']) ?></td>
                                <td><?= esc($website['template_name']) ?></td>
                                <td><?= esc(ucfirst($website['status'])) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No websites found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
