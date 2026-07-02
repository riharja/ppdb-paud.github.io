<?php

namespace App\Controllers;

use App\Models\PendaftaranModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $model = new PendaftaranModel();

        $data = [
            'title'     => 'Dashboard',
            'total'     => $model->countAllResults(),
            'menunggu'  => $model->where('status', 'Menunggu')->countAllResults(),
            'diterima'  => $model->where('status', 'Diterima')->countAllResults(),
            'ditolak'   => $model->where('status', 'Ditolak')->countAllResults(),
            'terbaru'   => $model->orderBy('id', 'DESC')->findAll(5),
        ];

        return view('dashboard/index', $data);
    }
}
