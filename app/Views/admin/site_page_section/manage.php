<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="mb-1">Manage Page Sections</h3>
        <p class="text-muted mb-0">
            <?= esc($page['site_name']) ?> / <?= esc($page['title']) ?>
        </p>
    </div>
    <a href="<?= site_url('admin/page-sections') ?>" class="btn btn-light">
        Back to Pages
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif ?>

        <form action="<?= site_url('admin/page-sections/save/' . $page['id']) ?>" method="post">
            <?= csrf_field() ?>

            <?php if (!empty($sections)): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Assign</th>
                                <th>Section Name</th>
                                <th>Section Type</th>
                                <th>View</th>
                                <th>Sort Order</th>
                                <th>Enabled</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sections as $section): ?>
                                <?php
                                    $sectionId = $section['id'];
                                    $assignment = $assignedMap[$sectionId] ?? null;
                                    $assigned = $assignment !== null;
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               name="section_ids[]"
                                               value="<?= esc($sectionId) ?>"
                                               class="form-check-input"
                                               <?= $assigned ? 'checked' : '' ?>>
                                    </td>

                                    <td><?= esc($section['section_name']) ?></td>
                                    <td><?= esc($section['section_type']) ?></td>
                                    <td><?= esc($section['view_key']) ?></td>

                                    <td style="width: 120px;">
                                        <input type="number"
                                               name="sort_order[<?= esc($sectionId) ?>]"
                                               class="form-control form-control-sm"
                                               value="<?= esc($assignment['sort_order'] ?? $section['sort_order']) ?>">
                                    </td>

                                    <td>
                                        <input type="checkbox"
                                               name="enabled[<?= esc($sectionId) ?>]"
                                               value="1"
                                               class="form-check-input"
                                               <?= ($assignment && (int) $assignment['is_enabled'] === 1) ? 'checked' : '' ?>>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">No sections are available for this website.</p>
            <?php endif ?>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    Save Section Assignments
                </button>
                <a href="<?= site_url('admin/page-sections') ?>" class="btn btn-light">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>