<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form class="d-flex" method="get" action="<?= site_url('pendaftaran') ?>">
            <input type="text" name="q" class="form-control me-2" placeholder="Cari nama anak / no. pendaftaran"
                   value="<?= esc($q) ?>">
            <button class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
        </form>
        <a href="<?= site_url('pendaftaran/tambah') ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Pendaftaran
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Foto</th>
                    <th>No. Pendaftaran</th>
                    <th>Nama Anak</th>
                    <th>JK</th>
                    <th>Tgl Lahir</th>
                    <th>Nama Ayah</th>
                    <th>Status</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $row): ?>
                <tr>
                    <td>
                        <?php if ($row['foto']): ?>
                            <img src="<?= base_url('uploads/foto/' . $row['foto']) ?>" class="foto-preview" style="width:45px;height:45px;">
                        <?php else: ?>
                            <i class="bi bi-person-circle fs-3 text-muted"></i>
                        <?php endif; ?>
                    </td>
                    <td><?= esc($row['no_pendaftaran']) ?></td>
                    <td><?= esc($row['nama_anak']) ?></td>
                    <td><?= esc($row['jenis_kelamin']) ?></td>
                    <td><?= esc($row['tanggal_lahir']) ?></td>
                    <td><?= esc($row['nama_ayah']) ?></td>
                    <td>
                        <?php
                            $badge = match($row['status']) {
                                'Diterima' => 'success',
                                'Ditolak'  => 'danger',
                                default    => 'warning',
                            };
                        ?>
                        <span class="badge bg-<?= $badge ?>"><?= esc($row['status']) ?></span>
                    </td>
                    <td>
                        <a href="<?= site_url('pendaftaran/detail/' . $row['id']) ?>" class="btn btn-sm btn-outline-info" title="Detail">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="<?= site_url('pendaftaran/edit/' . $row['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="<?= site_url('pendaftaran/hapus/' . $row['id']) ?>" class="btn btn-sm btn-outline-danger"
                           title="Hapus" onclick="return confirm('Hapus data ini?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($list)): ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Belum ada data pendaftaran</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div>
        <?= $pager->links() ?>
    </div>
</div>

<?= $this->endSection() ?>
