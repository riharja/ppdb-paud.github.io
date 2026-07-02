<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="card p-4">
    <h6 class="fw-bold mb-3">Form Tambah Pendaftaran</h6>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('pendaftaran/simpan') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="row g-3">
            <div class="col-md-3 text-center">
                <label class="form-label d-block">Foto Anak</label>
                <img id="previewFoto" src="https://placehold.co/110x110?text=Foto" class="foto-preview mb-2">
                <input type="file" name="foto" accept="image/*" class="form-control form-control-sm"
                       onchange="previewImage(this,'previewFoto')">
            </div>

            <div class="col-md-9">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap Anak</label>
                        <input type="text" name="nama_anak" class="form-control" value="<?= old('nama_anak') ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Anak Ke</label>
                        <input type="number" name="anak_ke" class="form-control" min="1" value="<?= old('anak_ke') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" value="<?= old('tempat_lahir') ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?= old('tanggal_lahir') ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Agama</label>
                        <input type="text" name="agama" class="form-control" value="<?= old('agama') ?>" required>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <h6 class="fw-bold mb-3">Data Orang Tua</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="<?= old('nama_ayah') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="<?= old('nama_ibu') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Pekerjaan Ayah</label>
                <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= old('pekerjaan_ayah') ?>">
            </div>
            <div class="col-md-6">
                <label class="form-label">Pekerjaan Ibu</label>
                <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= old('pekerjaan_ibu') ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">No. HP / WhatsApp</label>
                <input type="text" name="no_hp" class="form-control" value="<?= old('no_hp') ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tahun Ajaran</label>
                <input type="text" name="tahun_ajaran" class="form-control" placeholder="2026/2027" value="<?= old('tahun_ajaran') ?>" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Alamat Lengkap</label>
                <textarea name="alamat" class="form-control" rows="2" required><?= old('alamat') ?></textarea>
            </div>
        </div>

        <hr class="my-4">
        <h6 class="fw-bold mb-3">Berkas Pendukung (opsional)</h6>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Kartu Keluarga (jpg/png/pdf)</label>
                <input type="file" name="kartu_keluarga" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Akta Kelahiran (jpg/png/pdf)</label>
                <input type="file" name="akta_kelahiran" class="form-control">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
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
