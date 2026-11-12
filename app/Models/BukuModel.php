<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table         = 'buku';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['judul', 'penulis', 'tahun_terbit', 'kategori'];
    protected $useTimestamps = true;

    // Aturan validasi (kolom wajib tidak boleh kosong)
    protected $validationRules = [
        'judul'        => 'required|max_length[200]',
        'penulis'      => 'required|max_length[150]',
        'tahun_terbit' => 'required|integer|greater_than[999]|less_than_equal_to[2100]',
        'kategori'     => 'required|max_length[80]',
    ];

    protected $validationMessages = [
        'judul' => [
            'required'   => 'Judul buku wajib diisi.',
            'max_length' => 'Judul maksimal 200 karakter.',
        ],
        'penulis' => [
            'required'   => 'Nama penulis wajib diisi.',
            'max_length' => 'Nama penulis maksimal 150 karakter.',
        ],
        'tahun_terbit' => [
            'required'           => 'Tahun terbit wajib diisi.',
            'integer'            => 'Tahun terbit harus berupa angka.',
            'greater_than'       => 'Tahun terbit tidak valid.',
            'less_than_equal_to' => 'Tahun terbit tidak valid.',
        ],
        'kategori' => [
            'required' => 'Kategori wajib dipilih.',
        ],
    ];

    // Daftar kategori yang tersedia di form
    public const KATEGORI = [
        'Novel', 'Pengembangan Diri', 'Teknologi', 'Sejarah', 'Sains', 'Lainnya',
    ];
}
