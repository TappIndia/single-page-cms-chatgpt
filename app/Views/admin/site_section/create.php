<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="mb-1">Add Website Section</h3>
    <p class="text-muted mb-0">Create a reusable section for a website.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= site_url('admin/site-sections/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-6 mb-3">
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

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Name</label>
                    <input type="text" name="section_name" class="form-control"
                           placeholder="Main Hero" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Key</label>
                    <input type="text" name="section_key" class="form-control"
                           placeholder="hero-main" required>
                    <small class="text-muted">Unique within this website. Use lowercase and hyphens.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Type</label>
                    <select name="section_type" id="section_type" class="form-select" required>
                        <option value="">Select Type</option>
                        <?php foreach ($sectionTypes as $type): ?>
                            <option value="<?= esc($type['type_key']) ?>">
                                <?= esc($type['type_name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Variation</label>
                    <select name="view_key" id="view_key" class="form-select" required>
                        <option value="">Select Variation</option>
                        <?php foreach ($variations as $variation): ?>
                            <option value="<?= esc($variation['variation_key']) ?>"
                                    data-type="<?= esc($variation['type_key'] ?? '') ?>">
                                <?= esc($variation['variation_name']) ?>
                                (<?= esc($variation['variation_key']) ?>)
                            </option>
                        <?php endforeach ?>
                    </select>
                    <small class="text-muted">Available variations depend on the selected website template and section type.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Content JSON</label>
                <textarea name="content_json" class="form-control font-monospace"
                          rows="6" placeholder='{"title":"Welcome","subtitle":"Your headline"}'></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Layout JSON</label>
                <textarea name="layout_json" class="form-control font-monospace"
                          rows="4" placeholder='{"container":"container","background":"light"}'></textarea>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="is_enabled" value="1"
                       class="form-check-input" checked>
                <label class="form-check-label">Enable this section</label>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Save Section</button>
                <a href="<?= site_url('admin/site-sections') ?>" class="btn btn-light">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('section_type');
    const variationSelect = document.getElementById('view_key');

    function filterVariations() {
        const selectedType = typeSelect.value;

        Array.from(variationSelect.options).forEach(function (option, index) {
            if (index === 0) return;

            const optionType = option.dataset.type;
            option.hidden = optionType !== '' && optionType !== selectedType;
        });

        const selectedOption = variationSelect.selectedOptions[0];
        if (selectedOption && selectedOption.hidden) {
            variationSelect.value = '';
        }
    }

    typeSelect.addEventListener('change', filterVariations);
    filterVariations();
});
</script>

<?= $this->endSection() ?>
