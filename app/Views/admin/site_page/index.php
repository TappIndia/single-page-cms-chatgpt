<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Website Pages</h3>
        <p class="text-muted mb-0">Manage pages belonging to your websites.</p>
    </div>
    <a href="<?= site_url('admin/pages/create') ?>" class="btn btn-primary">
        Add Page
    </a>
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
                        <th>Type</th>
                        <th>Homepage</th>
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
                                <td><?= esc(ucfirst($page['page_type'])) ?></td>
                                <td>
                                    <?= $page['is_homepage']
                                        ? '<span class="badge bg-primary">Yes</span>'
                                        : '<span class="text-muted">No</span>' ?>
                                </td>
                                <td>
                                    <?= esc(ucfirst($page['status'])) ?>
                                </td>
                                <td>
                                    <a href="<?= site_url('admin/pages/edit/' . $page['id']) ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="<?= site_url('admin/pages/delete/' . $page['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this page?')">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
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
