<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="p-4 p-md-5 mb-4 bg-white rounded-3 shadow-sm">
    <h1 class="display-6 fw-bold">Aplikasi Inventaris Buku</h1>
    <p class="lead mb-4">Catat koleksi buku beserta penulis, tahun terbit, dan kategorinya dengan mudah.</p>
    <a href="<?= site_url('buku') ?>" class="btn btn-primary me-2">Lihat Daftar Buku</a>
    <a href="<?= site_url('buku/tambah') ?>" class="btn btn-outline-primary">Tambah Buku</a>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body">
                <div class="text-muted">Total Buku</div>
                <div class="display-5 fw-bold"><?= esc($total) ?></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white fw-semibold">Buku Terbaru</div>
            <ul class="list-group list-group-flush">
                <?php if (empty($terbaru)): ?>
                    <li class="list-group-item text-muted">Belum ada data.</li>
                <?php else: foreach ($terbaru as $b): ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= esc($b['judul']) ?> <small class="text-muted">&mdash; <?= esc($b['penulis']) ?></small></span>
                        <span class="badge text-bg-secondary"><?= esc($b['kategori']) ?></span>
                    </li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
