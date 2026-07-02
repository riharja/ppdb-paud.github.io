<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4">
    <div class="row">
        <div class="col-md-3 text-center">
            <?php if ($row['foto']): ?>
                <img src="<?= base_url('uploads/foto/' . $row['foto']) ?>" class="img-fluid rounded shadow-sm">
            <?php else: ?>
                <i class="bi bi-person-circle" style="font-size:100px;color:#ccc;"></i>
            <?php endif; ?>
        </div>
        <div class="col-md-9">
            <h5 class="fw-bold"><?= esc($row['nama_anak']) ?></h5>
            <p class="text-muted">No. Pendaftaran: <?= esc($row['no_pendaftaran']) ?> &middot;
                <?php
                    $badge = match($row['status']) {
                        'Diterima' => 'success',
                        'Ditolak'  => 'danger',
                        default    => 'warning',
                    };
                ?>
                <span class="badge bg-<?= $badge ?>"><?= esc($row['status']) ?></span>
            </p>

            <table class="table table-sm w-75">
                <tr><th width="200">Jenis Kelamin</th><td><?= esc($row['jenis_kelamin']) ?></td></tr>
                <tr><th>Tempat, Tgl Lahir</th><td><?= esc($row['tempat_lahir']) ?>, <?= esc($row['tanggal_lahir']) ?></td></tr>
                <tr><th>Agama</th><td><?= esc($row['agama']) ?></td></tr>
                <tr><th>Anak Ke</th><td><?= esc($row['anak_ke']) ?></td></tr>
                <tr><th>Nama Ayah</th><td><?= esc($row['nama_ayah']) ?> (<?= esc($row['pekerjaan_ayah']) ?>)</td></tr>
                <tr><th>Nama Ibu</th><td><?= esc($row['nama_ibu']) ?> (<?= esc($row['pekerjaan_ibu']) ?>)</td></tr>
                <tr><th>No. HP</th><td><?= esc($row['no_hp']) ?></td></tr>
                <tr><th>Alamat</th><td><?= esc($row['alamat']) ?></td></tr>
                <tr><th>Tahun Ajaran</th><td><?= esc($row['tahun_ajaran']) ?></td></tr>
                <tr><th>Kartu Keluarga</th><td>
                    <?php if ($row['kartu_keluarga']): ?>
                        <a href="<?= base_url('uploads/berkas/' . $row['kartu_keluarga']) ?>" target="_blank">Lihat berkas</a>
                    <?php else: ?>-<?php endif; ?>
                </td></tr>
                <tr><th>Akta Kelahiran</th><td>
                    <?php if ($row['akta_kelahiran']): ?>
                        <a href="<?= base_url('uploads/berkas/' . $row['akta_kelahiran']) ?>" target="_blank">Lihat berkas</a>
                    <?php else: ?>-<?php endif; ?>
                </td></tr>
            </table>

            <a href="<?= site_url('pendaftaran/edit/' . $row['id']) ?>" class="btn btn-warning"><i class="bi bi-pencil"></i> Edit</a>
            <a href="<?= site_url('pendaftaran') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
