<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="mb-1">Page Section Management</h3>
    <p class="text-muted mb-0">Assign and organize sections on individual website pages.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>Page Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pages)): ?>
                        <?php foreach ($pages as $page): ?>
                            <tr>
                                <td><?= esc($page['id']) ?></td>
                                <td><?= esc($page['site_name']) ?></td>
                                <td><?= esc($page['title']) ?></td>
                                <td><?= esc($page['slug']) ?></td>
                                <td><?= esc(ucfirst($page['status'])) ?></td>
                                <td>
                                    <a href="<?= site_url('admin/page-sections/manage/' . $page['id']) ?>"
                                       class="btn btn-sm btn-primary">
                                        Manage Sections
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No pages found.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>