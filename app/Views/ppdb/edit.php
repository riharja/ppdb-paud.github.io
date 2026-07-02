<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4">
    <h6 class="fw-bold mb-3">Form Edit Pendaftaran - <?= esc($row['no_pendaftaran']) ?></h6>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('pendaftaran/update/' . $row['id']) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-3 text-center">
                <label class="form-label d-block">Foto Anak</label>
                <?php $fotoUrl = $row['foto'] ? base_url('uploads/foto/' . $row['foto']) : 'https://placehold.co/110x110?text=Foto'; ?>
                <img id="previewFoto" src="<?= $fotoUrl ?>" class="foto-preview mb-2">
                <input type="file" name="foto" accept="image/*" class="form-control form-control-sm"
                       onchange="previewImage(this,'previewFoto')">
            </div>

            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap Anak</label>
                        <input type="text" name="nama_anak" class="form-control" value="<?= old('nama_anak', $row['nama_anak']) ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <?php foreach (['Laki-laki', 'Perempuan'] as $jk): ?>
                                <option value="<?= $jk ?>" <?= $row['jenis_kelamin'] == $jk ? 'selected' : '' ?>><?= $jk ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Anak Ke</label>
                        <input type="number" name="anak_ke" class="form-control" min="1" value="<?= old('anak_ke', $row['anak_ke']) ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="<?= old('tempat_lahir', $row['tempat_lahir']) ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir', $row['tanggal_lahir']) ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Agama</label>
                        <input type="text" name="agama" class="form-control" value="<?= old('agama', $row['agama']) ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <h6 class="fw-bold mb-3">Data Orang Tua</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="<?= old('nama_ayah', $row['nama_ayah']) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="<?= old('nama_ibu', $row['nama_ibu']) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= old('pekerjaan_ayah', $row['pekerjaan_ayah']) ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= old('pekerjaan_ibu', $row['pekerjaan_ibu']) ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">No. HP / WhatsApp</label>
                <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp', $row['no_hp']) ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" class="form-control" value="<?= old('tahun_ajaran', $row['tahun_ajaran']) ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <?php foreach (['Menunggu', 'Diterima', 'Ditolak'] as $st): ?>
                        <option value="<?= $st ?>" <?= $row['status'] == $st ? 'selected' : '' ?>><?= $st ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="2" required><?= old('alamat', $row['alamat']) ?></textarea>
            </div>
        </div>

        <hr class="my-4">
        <h6 class="fw-bold mb-3">Berkas Pendukung (kosongkan jika tidak ingin mengubah)</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kartu Keluarga</label>
                <input type="file" name="kartu_keluarga" class="form-control">
                <?php if ($row['kartu_keluarga']): ?>
                    <a href="<?= base_url('uploads/berkas/' . $row['kartu_keluarga']) ?>" target="_blank" class="small">Lihat berkas saat ini</a>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <label class="form-label">Akta Kelahiran</label>
                <input type="file" name="akta_kelahiran" class="form-control">
                <?php if ($row['akta_kelahiran']): ?>
                    <a href="<?= base_url('uploads/berkas/' . $row['akta_kelahiran']) ?>" target="_blank" class="small">Lihat berkas saat ini</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
            <a href="<?= site_url('pendaftaran') ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
function previewImage(input, targetId) {
    if (input.files && input.files[0]) {
        document.getElementById(targetId).src = URL.createObjectURL(input.files[0]);
    }
}
</script>

<?= $this->endSection() ?>
