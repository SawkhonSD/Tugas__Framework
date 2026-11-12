<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{
    public function index(): string
    {
        $model = new BukuModel();

        return view('home', [
            'title'   => 'Beranda',
            'total'   => $model->countAllResults(),
            'terbaru' => $model->orderBy('id', 'DESC')->findAll(5),
        ]);
    }
}
