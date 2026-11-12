<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h2 class="h4 mb-3">Tambah Buku</h2>
<div class="card shadow-sm"><div class="card-body">
    <?= view('buku/_form', ['action' => 'buku/simpan', 'kategori' => $kategori]) ?>
</div></div>
<?= $this->endSection() ?>
