<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="mb-1">Edit Website Page</h3>
    <p class="text-muted mb-0">Update page information and settings.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= site_url('admin/pages/update/' . $page['id']) ?>" method="post">

            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Website</label>
                <select name="site_id" class="form-select" required>
                    <?php foreach ($sites as $site): ?>
                        <option value="<?= esc($site['id']) ?>"
                            <?= $page['site_id'] == $site['id'] ? 'selected' : '' ?>>
                            <?= esc($site['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Page Title</label>
                <input type="text" name="title" class="form-control"
                       value="<?= esc($page['title']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control"
                       value="<?= esc($page['slug']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Page Type</label>
                <select name="page_type" class="form-select">
                    <?php foreach (['standard', 'landing', 'contact'] as $type): ?>
                        <option value="<?= $type ?>"
                            <?= $page['page_type'] === $type ? 'selected' : '' ?>>
                            <?= ucfirst($type) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control"
                       value="<?= esc($page['meta_title'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="3"><?= esc($page['meta_description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <textarea name="meta_keywords" class="form-control" rows="2"><?= esc($page['meta_keywords'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="<?= esc($page['sort_order']) ?>">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_enabled" value="1"
                       class="form-check-input" <?= $page['is_enabled'] ? 'checked' : '' ?>>
                <label class="form-check-label">Enabled</label>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_homepage" value="1"
                       class="form-check-input" <?= $page['is_homepage'] ? 'checked' : '' ?>>
                <label class="form-check-label">Set as Homepage</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <?php foreach (['draft', 'published', 'archived'] as $status): ?>
                        <option value="<?= $status ?>"
                            <?= $page['status'] === $status ? 'selected' : '' ?>>
                            <?= ucfirst($status) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Page</button>
                <a href="<?= site_url('admin/pages') ?>" class="btn btn-light">Cancel</a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>