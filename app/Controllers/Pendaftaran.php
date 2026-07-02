<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;
use CodeIgniter\HTTP\RedirectResponse;

class Pendaftaran extends BaseController
{
    protected PendaftaranModel $model;

    public function __construct()
    {
        $this->model = new PendaftaranModel();
    }

    // ================= LIST =================
    public function index()
    {
        $keyword = $this->request->getGet('q');

        $builder = $this->model->orderBy('id', 'DESC');

        if ($keyword) {
            $builder->groupStart()
                ->like('nama_anak', $keyword)
                ->orLike('no_pendaftaran', $keyword)
                ->orLike('nama_ayah', $keyword)
                ->groupEnd();
        }

        $data = [
            'title' => 'Data Pendaftaran PPDB',
            'list'  => $builder->paginate(10),
            'pager' => $this->model->pager,
            'q'     => $keyword,
        ];

        return view('ppdb/index', $data);
    }

    // ================= FORM TAMBAH =================
    public function create()
    {
        $data = [
            'title' => 'Tambah Pendaftaran',
            'validation' => \Config\Services::validation(),
        ];

        return view('ppdb/create', $data);
    }

    // ================= SIMPAN TAMBAH =================
    public function store()
    {
        if (! $this->validate($this->model->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fotoName = $this->uploadFile('foto', 'uploads/foto');
        $kkName   = $this->uploadFile('kartu_keluarga', 'uploads/berkas');
        $aktaName = $this->uploadFile('akta_kelahiran', 'uploads/berkas');

        $data = [
            'no_pendaftaran' => $this->model->generateNoPendaftaran(),
            'nama_anak'      => $this->request->getPost('nama_anak'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'   => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'agama'          => $this->request->getPost('agama'),
            'anak_ke'        => $this->request->getPost('anak_ke'),
            'nama_ayah'      => $this->request->getPost('nama_ayah'),
            'nama_ibu'       => $this->request->getPost('nama_ibu'),
            'pekerjaan_ayah' => $this->request->getPost('pekerjaan_ayah'),
            'pekerjaan_ibu'  => $this->request->getPost('pekerjaan_ibu'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'alamat'         => $this->request->getPost('alamat'),
            'foto'           => $fotoName,
            'kartu_keluarga' => $kkName,
            'akta_kelahiran' => $aktaName,
            'tahun_ajaran'   => $this->request->getPost('tahun_ajaran'),
            'status'         => 'Menunggu',
            'created_by'     => session()->get('user_id'),
        ];

        $this->model->insert($data);

        return redirect()->to('/pendaftaran')->with('success', 'Data pendaftaran berhasil ditambahkan.');
    }

    // ================= DETAIL =================
    public function show($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/pendaftaran')->with('error', 'Data tidak ditemukan.');
        }

        return view('ppdb/show', ['title' => 'Detail Pendaftaran', 'row' => $row]);
    }

    // ================= FORM EDIT =================
    public function edit($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/pendaftaran')->with('error', 'Data tidak ditemukan.');
        }

        return view('ppdb/edit', [
            'title'      => 'Edit Pendaftaran',
            'row'        => $row,
            'validation' => \Config\Services::validation(),
        ]);
    }

    // ================= UPDATE =================
    public function update($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/pendaftaran')->with('error', 'Data tidak ditemukan.');
        }

        $rules = $this->model->getValidationRules();

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_anak'      => $this->request->getPost('nama_anak'),
            'jenis_kelamin'  => $this->request->getPost('jenis_kelamin'),
            'tempat_lahir'   => $this->request->getPost('tempat_lahir'),
            'tanggal_lahir'  => $this->request->getPost('tanggal_lahir'),
            'agama'          => $this->request->getPost('agama'),
            'anak_ke'        => $this->request->getPost('anak_ke'),
            'nama_ayah'      => $this->request->getPost('nama_ayah'),
            'nama_ibu'       => $this->request->getPost('nama_ibu'),
            'pekerjaan_ayah' => $this->request->getPost('pekerjaan_ayah'),
            'pekerjaan_ibu'  => $this->request->getPost('pekerjaan_ibu'),
            'no_hp'          => $this->request->getPost('no_hp'),
            'alamat'         => $this->request->getPost('alamat'),
            'tahun_ajaran'   => $this->request->getPost('tahun_ajaran'),
            'status'         => $this->request->getPost('status') ?? $row['status'],
        ];

        // Ganti foto jika ada upload baru
        $fotoBaru = $this->uploadFile('foto', 'uploads/foto');
        if ($fotoBaru) {
            $this->deleteOldFile('uploads/foto', $row['foto']);
            $data['foto'] = $fotoBaru;
        }

        $kkBaru = $this->uploadFile('kartu_keluarga', 'uploads/berkas');
        if ($kkBaru) {
            $this->deleteOldFile('uploads/berkas', $row['kartu_keluarga']);
            $data['kartu_keluarga'] = $kkBaru;
        }

        $aktaBaru = $this->uploadFile('akta_kelahiran', 'uploads/berkas');
        if ($aktaBaru) {
            $this->deleteOldFile('uploads/berkas', $row['akta_kelahiran']);
            $data['akta_kelahiran'] = $aktaBaru;
        }

        $this->model->update($id, $data);

        return redirect()->to('/pendaftaran')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    // ================= HAPUS =================
    public function delete($id)
    {
        $row = $this->model->find($id);
        if (! $row) {
            return redirect()->to('/pendaftaran')->with('error', 'Data tidak ditemukan.');
        }

        $this->deleteOldFile('uploads/foto', $row['foto']);
        $this->deleteOldFile('uploads/berkas', $row['kartu_keluarga']);
        $this->deleteOldFile('uploads/berkas', $row['akta_kelahiran']);

        $this->model->delete($id);

        return redirect()->to('/pendaftaran')->with('success', 'Data pendaftaran berhasil dihapus.');
    }

    // ================= HELPER UPLOAD =================
    private function uploadFile(string $field, string $folder): ?string
    {
        $file = $this->request->getFile($field);

        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $newName   = $file->getRandomName();
        $targetDir = FCPATH . $folder;

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $newName);

        return $newName;
    }

    private function deleteOldFile(string $folder, ?string $filename): void
    {
        if (! $filename) {
            return;
        }

        $path = FCPATH . $folder . '/' . $filename;
        if (is_file($path)) {
            unlink($path);
        }
    }
}
