<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Template Management</h2>
    <button class="btn btn-primary" disabled>Add Template</button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Template Name</th>
                        <th>Slug</th>
                        <th>CSS Framework</th>
                        <th>Framework Version</th>
                        <th>Template Version</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($templates)): ?>
                        <?php foreach ($templates as $template): ?>
                            <tr>
                                <td><?= esc($template['id']) ?></td>
                                <td><?= esc($template['name']) ?></td>
                                <td><?= esc($template['slug']) ?></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= esc(ucfirst($template['css_framework'])) ?>
                                    </span>
                                </td>
                                <td><?= esc($template['framework_version']) ?></td>
                                <td><?= esc($template['version']) ?></td>
                                <td><?= esc(ucfirst($template['status'])) ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No templates found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
