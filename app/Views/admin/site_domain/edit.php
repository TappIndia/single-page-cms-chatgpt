<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Edit Domain</h3>
        <p class="text-muted mb-0">Update website domain details.</p>
    </div>

    <a href="<?= site_url('admin/domains') ?>" class="btn btn-outline-secondary">
        Back to Domains
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <form action="<?= site_url('admin/domains/update/' . $domain['id']) ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label">Website</label>
                <select name="site_id" class="form-select" required>
                    <?php foreach ($sites as $site): ?>
                        <option
                            value="<?= esc($site['id']) ?>"
                            <?= $domain['site_id'] == $site['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($site['name']) ?>
                        </option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Domain Name</label>
                <input
                    type="text"
                    name="domain"
                    class="form-control"
                    value="<?= esc($domain['domain']) ?>"
                    required
                >
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="is_primary"
                        value="1"
                        class="form-check-input"
                        id="is_primary"
                        <?= $domain['is_primary'] ? 'checked' : '' ?>
                    >
                    <label class="form-check-label" for="is_primary">
                        Set as Primary Domain
                    </label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="active" <?= $domain['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $domain['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Domain</button>

        </form>
    </div>
</div>

<?= $this->endSection() ?>
