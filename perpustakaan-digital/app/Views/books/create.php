<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4><i class="fas fa-plus"></i> Tambah Buku Baru</h4>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/books/store') ?>" method="POST">
                        <?= csrf_field() ?>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="judul_buku" class="form-label">
                                    <i class="fas fa-book"></i> Judul Buku *
                                </label>
                                <input type="text" 
                                       class="form-control <?= $validation->hasError('judul_buku') ? 'is-invalid' : '' ?>" 
                                       id="judul_buku" 
                                       name="judul_buku" 
                                       value="<?= old('judul_buku') ?>"
                                       placeholder="Masukkan judul buku"
                                       required>
                                <?php if ($validation->hasError('judul_buku')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('judul_buku') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="penulis" class="form-label">
                                    <i class="fas fa-user-edit"></i> Penulis *
                                </label>
                                <input type="text" 
                                       class="form-control <?= $validation->hasError('penulis') ? 'is-invalid' : '' ?>" 
                                       id="penulis" 
                                       name="penulis" 
                                       value="<?= old('penulis') ?>"
                                       placeholder="Nama penulis"
                                       required>
                                <?php if ($validation->hasError('penulis')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penulis') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="penerbit" class="form-label">
                                    <i class="fas fa-building"></i> Penerbit *
                                </label>
                                <input type="text" 
                                       class="form-control <?= $validation->hasError('penerbit') ? 'is-invalid' : '' ?>" 
                                       id="penerbit" 
                                       name="penerbit" 
                                       value="<?= old('penerbit') ?>"
                                       placeholder="Nama penerbit"
                                       required>
                                <?php if ($validation->hasError('penerbit')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('penerbit') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tahun_terbit" class="form-label">
                                    <i class="fas fa-calendar"></i> Tahun Terbit *
                                </label>
                                <input type="number" 
                                       class="form-control <?= $validation->hasError('tahun_terbit') ? 'is-invalid' : '' ?>" 
                                       id="tahun_terbit" 
                                       name="tahun_terbit" 
                                       value="<?= old('tahun_terbit') ?>"
                                       placeholder="<?= date('Y') ?>"
                                       min="1900" 
                                       max="<?= date('Y') ?>"
                                       required>
                                <?php if ($validation->hasError('tahun_terbit')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('tahun_terbit') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">
                                    <i class="fas fa-tag"></i> Kategori *
                                </label>
                                <select class="form-select <?= $validation->hasError('kategori') ? 'is-invalid' : '' ?>" 
                                        id="kategori" 
                                        name="kategori" 
                                        required>
                                    <option value="">Pilih kategori</option>
                                    <option value="Fiksi" <?= old('kategori') == 'Fiksi' ? 'selected' : '' ?>>Fiksi</option>
                                    <option value="Non-Fiksi" <?= old('kategori') == 'Non-Fiksi' ? 'selected' : '' ?>>Non-Fiksi</option>
                                    <option value="Sejarah" <?= old('kategori') == 'Sejarah' ? 'selected' : '' ?>>Sejarah</option>
                                    <option value="Biografi" <?= old('kategori') == 'Biografi' ? 'selected' : '' ?>>Biografi</option>
                                    <option value="Teknologi" <?= old('kategori') == 'Teknologi' ? 'selected' : '' ?>>Teknologi</option>
                                    <option value="Pendidikan" <?= old('kategori') == 'Pendidikan' ? 'selected' : '' ?>>Pendidikan</option>
                                    <option value="Kesehatan" <?= old('kategori') == 'Kesehatan' ? 'selected' : '' ?>>Kesehatan</option>
                                    <option value="Agama" <?= old('kategori') == 'Agama' ? 'selected' : '' ?>>Agama</option>
                                    <option value="Lainnya" <?= old('kategori') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                </select>
                                <div class="form-text">Atau ketik kategori baru di bawah</div>
                                <input type="text" 
                                       class="form-control mt-2" 
                                       id="kategori_custom" 
                                       placeholder="Kategori baru (opsional)">
                                <?php if ($validation->hasError('kategori')): ?>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('kategori') ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="sinopsis" class="form-label">
                                <i class="fas fa-align-left"></i> Sinopsis
                            </label>
                            <textarea class="form-control <?= $validation->hasError('sinopsis') ? 'is-invalid' : '' ?>" 
                                      id="sinopsis" 
                                      name="sinopsis" 
                                      rows="5" 
                                      placeholder="Ringkasan atau deskripsi buku (opsional)"><?= old('sinopsis') ?></textarea>
                            <?php if ($validation->hasError('sinopsis')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sinopsis') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('/books') ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Custom kategori input
document.getElementById('kategori_custom').addEventListener('input', function() {
    const customValue = this.value.trim();
    if (customValue) {
        const select = document.getElementById('kategori');
        // Clear selection
        select.value = '';
        // Set hidden input or update select value
        select.setAttribute('data-custom', customValue);
    }
});

// Submit form handling for custom kategori
document.querySelector('form').addEventListener('submit', function(e) {
    const kategoriSelect = document.getElementById('kategori');
    const kategoriCustom = document.getElementById('kategori_custom').value.trim();
    
    if (kategoriCustom && !kategoriSelect.value) {
        // Create hidden input for custom kategori
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'kategori';
        hiddenInput.value = kategoriCustom;
        this.appendChild(hiddenInput);
        
        // Remove kategori select name to avoid conflict
        kategoriSelect.removeAttribute('name');
    }
});
</script>
<?= $this->endSection() ?>