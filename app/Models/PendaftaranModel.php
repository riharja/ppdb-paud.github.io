<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'no_pendaftaran',
        'nama_anak',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'anak_ke',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'no_hp',
        'alamat',
        'foto',
        'kartu_keluarga',
        'akta_kelahiran',
        'status',
        'tahun_ajaran',
        'created_by',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'nama_anak'     => 'required|min_length[3]|max_length[100]',
        'jenis_kelamin' => 'required|in_list[Laki-laki,Perempuan]',
        'tempat_lahir'  => 'required',
        'tanggal_lahir' => 'required|valid_date',
        'agama'         => 'required',
        'nama_ayah'     => 'required',
        'nama_ibu'      => 'required',
        'no_hp'         => 'required|numeric|min_length[9]',
        'alamat'        => 'required',
        'tahun_ajaran'  => 'required',
    ];

    protected $validationMessages = [
        'nama_anak' => [
            'required'   => 'Nama anak wajib diisi.',
            'min_length' => 'Nama anak minimal 3 karakter.',
        ],
        'no_hp' => [
            'numeric' => 'Nomor HP hanya boleh angka.',
        ],
    ];

    /**
     * Membuat nomor pendaftaran otomatis, format: PPDB-YYYY-XXXX
     */
    public function generateNoPendaftaran(): string
    {
        $tahun = date('Y');
        $last  = $this->like('no_pendaftaran', "PPDB-{$tahun}-", 'after')
                      ->orderBy('id', 'DESC')
                      ->first();

        $urut = 1;
        if ($last) {
            $parts = explode('-', $last['no_pendaftaran']);
            $urut  = (int) end($parts) + 1;
        }

        return sprintf('PPDB-%s-%04d', $tahun, $urut);
    }

    public function rekap()
    {
        return $this->select('status, COUNT(*) as jumlah')
                    ->groupBy('status')
                    ->findAll();
    }
}
