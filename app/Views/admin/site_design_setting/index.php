<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Website Design Settings</h2>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Website</th>
                        <th>Setting Group</th>
                        <th>Setting Key</th>
                        <th>Type</th>
                        <th>Default Value</th>
                        <th>Custom Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($settings)): ?>
                        <?php foreach ($settings as $setting): ?>
                            <tr>
                                <td><?= esc($setting['id']) ?></td>
                                <td><?= esc($setting['site_name']) ?></td>
                                <td><?= esc($setting['setting_group']) ?></td>
                                <td><?= esc($setting['setting_key']) ?></td>
                                <td><?= esc($setting['setting_type']) ?></td>
                                <td>
                                    <code><?= esc($setting['default_value'] ?? '') ?></code>
                                </td>
                                <td>
                                    <code><?= esc($setting['custom_value'] ?? '') ?></code>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">
                                No design settings found.
                            </td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
