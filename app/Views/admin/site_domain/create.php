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
        <h3 class="mb-1">Add Domain</h3>
        <p class="text-muted mb-0">Connect a domain to a website.</p>
    </div>

    <a href="<?= site_url('admin/domains') ?>" class="btn btn-outline-secondary">
        Back to Domains
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= site_url('admin/domains/store') ?>" method="post">
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
                <label class="form-label">Domain Name</label>
                <input
                    type="text"
                    name="domain"
                    class="form-control"
                    placeholder="example.com"
                    required
                >
                <small class="text-muted">
                    Enter the domain without https:// or www prefix if possible.
                </small>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="is_primary"
                        value="1"
                        class="form-check-input"
                        id="is_primary"
                    >
                    <label class="form-check-label" for="is_primary">
                        Set as Primary Domain
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Save Domain
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
