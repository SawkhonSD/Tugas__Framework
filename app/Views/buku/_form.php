<?php $errors = session('errors') ?? []; ?>
<?php if ($errors): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $e): ?><li><?= esc($e) ?></li><?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?= form_open($action, ['novalidate' => 'novalidate']) ?>
    <div class="mb-3">
        <label for="judul" class="form-label">Judul <span class="text-danger">*</span></label>
        <input type="text" id="judul" name="judul" class="form-control <?= isset($errors['judul']) ? 'is-invalid' : '' ?>"
               value="<?= esc(old('judul', $buku['judul'] ?? '')) ?>">
    </div>
    <div class="mb-3">
        <label for="penulis" class="form-label">Penulis <span class="text-danger">*</span></label>
        <input type="text" id="penulis" name="penulis" class="form-control <?= isset($errors['penulis']) ? 'is-invalid' : '' ?>"
               value="<?= esc(old('penulis', $buku['penulis'] ?? '')) ?>">
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
            <input type="number" id="tahun_terbit" name="tahun_terbit" class="form-control <?= isset($errors['tahun_terbit']) ? 'is-invalid' : '' ?>"
                   value="<?= esc(old('tahun_terbit', $buku['tahun_terbit'] ?? '')) ?>">
        </div>
        <div class="col-md-6 mb-3">
            <label for="kategori" class="form-label">Kategori <span class="text-danger">*</span></label>
            <?php $pilih = old('kategori', $buku['kategori'] ?? ''); ?>
            <select id="kategori" name="kategori" class="form-select <?= isset($errors['kategori']) ? 'is-invalid' : '' ?>">
                <option value="">-- Pilih kategori --</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= esc($k) ?>" <?= $pilih === $k ? 'selected' : '' ?>><?= esc($k) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
    <a href="<?= site_url('buku') ?>" class="btn btn-outline-secondary">Batal</a>
<?= form_close() ?>
