<?php

namespace App\Controllers;

use App\Models\BukuModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Buku extends BaseController
{
    protected $helpers = ['form'];

    protected BukuModel $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    // READ: daftar buku (dengan pencarian & pagination)
    public function index(): string
    {
        $keyword = trim((string) $this->request->getGet('q'));

        if ($keyword !== '') {
            $this->bukuModel->groupStart()
                ->like('judul', $keyword)
                ->orLike('penulis', $keyword)
                ->orLike('kategori', $keyword)
                ->groupEnd();
        }

        $data = [
            'title'   => 'Daftar Buku',
            'buku'    => $this->bukuModel->orderBy('id', 'DESC')->paginate(10),
            'pager'   => $this->bukuModel->pager,
            'keyword' => $keyword,
        ];

        return view('buku/index', $data);
    }

    // CREATE: tampilkan form
    public function create(): string
    {
        return view('buku/tambah', [
            'title'    => 'Tambah Buku',
            'kategori' => BukuModel::KATEGORI,
        ]);
    }

    // CREATE: simpan data
    public function store()
    {
        $data = $this->request->getPost(['judul', 'penulis', 'tahun_terbit', 'kategori']);

        if (! $this->bukuModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->bukuModel->errors());
        }

        return redirect()->to('/buku')->with('success', 'Data buku berhasil ditambahkan.');
    }

    // UPDATE: tampilkan form ubah
    public function edit(int $id): string
    {
        return view('buku/ubah', [
            'title'    => 'Ubah Buku',
            'buku'     => $this->cariAtauGagal($id),
            'kategori' => BukuModel::KATEGORI,
        ]);
    }

    // UPDATE: simpan perubahan
    public function update(int $id)
    {
        $this->cariAtauGagal($id);

        $data       = $this->request->getPost(['judul', 'penulis', 'tahun_terbit', 'kategori']);
        $data['id'] = $id;

        if (! $this->bukuModel->save($data)) {
            return redirect()->back()->withInput()->with('errors', $this->bukuModel->errors());
        }

        return redirect()->to('/buku')->with('success', 'Data buku berhasil diubah.');
    }

    // DELETE: hapus data
    public function delete(int $id)
    {
        $this->cariAtauGagal($id);
        $this->bukuModel->delete($id);

        return redirect()->to('/buku')->with('success', 'Data buku berhasil dihapus.');
    }

    private function cariAtauGagal(int $id): array
    {
        $buku = $this->bukuModel->find($id);

        if ($buku === null) {
            throw PageNotFoundException::forPageNotFound('Data buku tidak ditemukan.');
        }

        return $buku;
    }
}
