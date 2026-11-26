<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="mb-4">
    <h3 class="mb-1">Edit Website Section</h3>
    <p class="text-muted mb-0">Update section information and content.</p>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="<?= site_url('admin/site-sections/update/' . $section['id']) ?>"
              method="post">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Website</label>
                    <select name="site_id" class="form-select" required>
                        <?php foreach ($sites as $site): ?>
                            <option value="<?= esc($site['id']) ?>"
                                <?= $section['site_id'] == $site['id'] ? 'selected' : '' ?>>
                                <?= esc($site['name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Name</label>
                    <input type="text" name="section_name" class="form-control"
                           value="<?= esc($section['section_name']) ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Key</label>
                    <input type="text" name="section_key" class="form-control"
                           value="<?= esc($section['section_key']) ?>" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Type</label>
                    <select name="section_type" id="section_type" class="form-select" required>
                        <?php foreach ($sectionTypes as $type): ?>
                            <option value="<?= esc($type['type_key']) ?>"
                                <?= $section['section_type'] === $type['type_key'] ? 'selected' : '' ?>>
                                <?= esc($type['type_name']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Section Variation</label>
                    <select name="view_key" id="view_key" class="form-select" required>
                        <?php foreach ($variations as $variation): ?>
                            <option value="<?= esc($variation['variation_key']) ?>"
                                    data-type="<?= esc($variation['type_key'] ?? '') ?>"
                                <?= $section['view_key'] === $variation['variation_key'] ? 'selected' : '' ?>>
                                <?= esc($variation['variation_name']) ?>
                                (<?= esc($variation['variation_key']) ?>)
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control"
                           value="<?= esc($section['sort_order']) ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Content JSON</label>
                <textarea name="content_json" class="form-control font-monospace"
                          rows="7"><?= esc($section['content_json'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Layout JSON</label>
                <textarea name="layout_json" class="form-control font-monospace"
                          rows="5"><?= esc($section['layout_json'] ?? '') ?></textarea>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="is_enabled" value="1"
                       class="form-check-input"
                       <?= !empty($section['is_enabled']) ? 'checked' : '' ?>>
                <label class="form-check-label">Enable this section</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Sync Status</label>
                <input type="text" class="form-control"
                       value="<?= esc($section['sync_status'] ?? '') ?>" disabled>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Section</button>
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

        Array.from(variationSelect.options).forEach(function (option) {
            const optionType = option.dataset.type;
            option.hidden = optionType !== '' && optionType !== selectedType;
        });
    }

    typeSelect.addEventListener('change', filterVariations);
    filterVariations();
});
</script>

<?= $this->endSection() ?>
