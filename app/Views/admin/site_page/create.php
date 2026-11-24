<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="mb-1">Add Website Page</h3>
    <p class="text-muted mb-0">Create a new page for your website.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= site_url('admin/pages/store') ?>" method="post">

            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Website</label>
                <select name="site_id" class="form-select" required>
                    <option value="">Select Website</option>
                    <?php foreach ($sites as $site): ?>
                        <option value="<?= esc($site['id']) ?>">
                            <?= esc($site['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Page Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control"
                       placeholder="about-us" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Page Type</label>
                <select name="page_type" class="form-select">
                    <option value="standard">Standard</option>
                    <option value="landing">Landing</option>
                    <option value="contact">Contact</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Title</label>
                <input type="text" name="meta_title" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Meta Keywords</label>
                <textarea name="meta_keywords" class="form-control" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_enabled" value="1"
                       class="form-check-input" checked>
                <label class="form-check-label">Enabled</label>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="is_homepage" value="1"
                       class="form-check-input">
                <label class="form-check-label">Set as Homepage</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Page</button>
                <a href="<?= site_url('admin/pages') ?>" class="btn btn-light">Cancel</a>
            </div>

        </form>
    </div>
</div>

<?= $this->endSection() ?>