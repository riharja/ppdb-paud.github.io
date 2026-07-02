<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="row g-3 mb-2">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Total Pendaftar</div>
            <div class="fs-3 fw-bold"><?= $total ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Menunggu</div>
            <div class="fs-3 fw-bold text-warning"><?= $menunggu ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Diterima</div>
            <div class="fs-3 fw-bold text-success"><?= $diterima ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted small">Ditolak</div>
            <div class="fs-3 fw-bold text-danger"><?= $ditolak ?></div>
        </div>
    </div>
</div>

<div class="card p-3">
    <h6 class="fw-bold mb-3">Pendaftar Terbaru</h6>
    <div class="table-responsive">
        <table class="table table-sm align-middle">
            <thead>
                <tr>
                    <th>No. Pendaftaran</th>
                    <th>Nama Anak</th>
                    <th>Tgl Lahir</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($terbaru as $row): ?>
                <tr>
                    <td><?= esc($row['no_pendaftaran']) ?></td>
                    <td><?= esc($row['nama_anak']) ?></td>
                    <td><?= esc($row['tanggal_lahir']) ?></td>
                    <td><span class="badge bg-secondary"><?= esc($row['status']) ?></span></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($terbaru)): ?>
                <tr><td colspan="4" class="text-center text-muted">Belum ada data</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
