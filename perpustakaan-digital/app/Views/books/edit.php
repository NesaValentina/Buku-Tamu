<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4><i class="fas fa-edit"></i> Edit Buku</h4>
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

                    <form action="<?= base_url('/books/update/' . $book['id_buku']) ?>" method="POST">
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
                                       value="<?= old('judul_buku', $book['judul_buku']) ?>"
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
                                       value="<?= old('penulis', $book['penulis']) ?>"
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
                                       value="<?= old('penerbit', $book['penerbit']) ?>"
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
                                       value="<?= old('tahun_terbit', $book['tahun_terbit']) ?>"
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
                                <input type="text" 
                                       class="form-control <?= $validation->hasError('kategori') ? 'is-invalid' : '' ?>" 
                                       id="kategori" 
                                       name="kategori" 
                                       value="<?= old('kategori', $book['kategori']) ?>"
                                       placeholder="Kategori buku"
                                       required>
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
                                      placeholder="Ringkasan atau deskripsi buku (opsional)"><?= old('sinopsis', $book['sinopsis']) ?></textarea>
                            <?php if ($validation->hasError('sinopsis')): ?>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('sinopsis') ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('/books/show/' . $book['id_buku']) ?>" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>