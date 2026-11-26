<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Website Sections</h3>
        <p class="text-muted mb-0">Manage reusable sections for your websites.</p>
    </div>
    <a href="<?= site_url('admin/site-sections/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Section
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>Section Name</th>
                        <th>Section Key</th>
                        <th>Type</th>
                        <th>Variation</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Sync</th>
                        <th width="150">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (!empty($sections)): ?>
                    <?php foreach ($sections as $section): ?>
                    <tr>
                        <td><?= esc($section['id']) ?></td>
                        <td><?= esc($section['site_name']) ?></td>
                        <td><?= esc($section['section_name']) ?></td>
                        <td><code><?= esc($section['section_key']) ?></code></td>
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
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?= site_url('admin/site-sections/edit/' . $section['id']) ?>"
                                   class="btn btn-sm btn-outline-primary">Edit</a>

                                <form action="<?= site_url('admin/site-sections/delete/' . $section['id']) ?>"
                                      method="post"
                                      onsubmit="return confirm('Delete this website section?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">
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
