<?php $flashes = \App\Core\Flash::pullAll(); if ($flashes): ?>
    <div class="mb-4">
        <?php foreach ($flashes as $f): ?>
            <div class="alert alert-<?= $this->e($f['type']) ?> alert-dismissible fade show" role="alert">
                <i class="bi bi-<?= $f['type'] === 'success' ? 'check-circle' : ($f['type'] === 'danger' ? 'exclamation-triangle' : 'info-circle') ?> me-2"></i>
                <?= $this->e($f['message']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
