<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    <h2 class="h4 mb-0">Daftar Buku</h2>
    <a href="<?= site_url('buku/tambah') ?>" class="btn btn-primary">+ Tambah Buku</a>
</div>

<form method="get" action="<?= site_url('buku') ?>" class="input-group mb-3">
    <input type="text" name="q" value="<?= esc($keyword) ?>" class="form-control" placeholder="Cari judul, penulis, atau kategori...">
    <button class="btn btn-outline-secondary" type="submit">Cari</button>
</form>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($buku)): ?>
                <tr><td colspan="6" class="text-center text-muted py-4">Data tidak ditemukan.</td></tr>
            <?php else: $no = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); foreach ($buku as $b): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($b['judul']) ?></td>
                    <td><?= esc($b['penulis']) ?></td>
                    <td><?= esc($b['tahun_terbit']) ?></td>
                    <td><span class="badge text-bg-secondary"><?= esc($b['kategori']) ?></span></td>
                    <td class="text-end text-nowrap">
                        <a href="<?= site_url('buku/ubah/' . $b['id']) ?>" class="btn btn-sm btn-warning">Ubah</a>
                        <?= form_open('buku/hapus/' . $b['id'], [
                            'class'    => 'd-inline',
                            'onsubmit' => "return confirm('Yakin ingin menghapus buku ini?');",
                        ]) ?>
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        <?= form_close() ?>
                    </td>
                </tr>
            <?php endforeach; endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3"><?= $pager->simpleLinks() ?></div>
<?= $this->endSection() ?>
