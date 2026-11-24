<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <span class="badge bg-success">System Ready</span>
</div>

<div class="row g-3">

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Total Websites</h5>
                <h2>2</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>Templates</h5>
                <h2>2</h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>CMS Status</h5>
                <h2 class="text-success">Ready</h2>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
