<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= esc(session()->getFlashdata('success')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= esc(session()->getFlashdata('error')) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Website Domains</h3>
        <p class="text-muted mb-0">Manage domains connected to your websites.</p>
    </div>
    <a href="<?= site_url('admin/domains/create') ?>" class="btn btn-primary">Add Domain</a>
<div>
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
                    <th>Action</th>
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
                                <td>
                                    <a href="<?= site_url('admin/domains/edit/' . $item['id']) ?>"
                                       class="btn btn-sm btn-outline-primary">
                                        Edit
                                    </a>

                                    <form action="<?= site_url('admin/domains/delete/' . $item['id']) ?>"
                                          method="post"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this domain?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
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

