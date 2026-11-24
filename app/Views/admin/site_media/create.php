<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Upload Media</h2>
    <a href="<?= site_url('admin/media') ?>" class="btn btn-secondary">
        Back to Media
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="<?= site_url('admin/media/upload') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Select Website</label>
                <select name="site_id" class="form-select" required>
                    <option value="">Choose Website</option>
                    <?php foreach ($sites as $site): ?>
                        <option value="<?= esc($site['id']) ?>">
                            <?= esc($site['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Select File</label>
                <input type="file" name="media_file" class="form-control" required>
                <small class="text-muted">
                    Supported formats and size limits will be validated during upload.
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Alt Text (Optional)</label>
                <input type="text" name="alt_text" class="form-control" maxlength="255">
            </div>

            <button type="submit" class="btn btn-primary">
                Upload Media
            </button>

        </form>

    </div>
</div>

<?= $this->endSection() ?>
