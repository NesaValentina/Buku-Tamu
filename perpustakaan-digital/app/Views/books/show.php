<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4><i class="fas fa-book-open"></i> Detail Buku</h4>
                        <?php if (session()->get('admin_logged_in')): ?>
                            <div class="btn-group" role="group">
                                <a href="<?= base_url('/books/edit/' . $book['id_buku']) ?>" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button type="button" 
                                        class="btn btn-danger btn-sm"
                                        onclick="confirmDelete('<?= base_url('/books/delete/' . $book['id_buku']) ?>', 'Hapus buku ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            <!-- Book Cover Placeholder -->
                            <div class="card bg-light" style="height: 300px;">
                                <div class="card-body d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <i class="fas fa-book fa-5x text-muted mb-3"></i>
                                        <p class="text-muted">Cover Buku</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h2 class="text-primary mb-3"><?= esc($book['judul_buku']) ?></h2>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong><i class="fas fa-user"></i> Penulis:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= esc($book['penulis']) ?>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong><i class="fas fa-building"></i> Penerbit:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= esc($book['penerbit']) ?>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong><i class="fas fa-calendar"></i> Tahun Terbit:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <?= esc($book['tahun_terbit']) ?>
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-sm-4">
                                    <strong><i class="fas fa-tag"></i> Kategori:</strong>
                                </div>
                                <div class="col-sm-8">
                                    <span class="badge bg-secondary fs-6">
                                        <?= esc($book['kategori']) ?>
                                    </span>
                                </div>
                            </div>
                            
                            <?php if (!empty($book['created_at'])): ?>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong><i class="fas fa-clock"></i> Ditambahkan:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= date('d F Y H:i', strtotime($book['created_at'])) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($book['updated_at']) && $book['updated_at'] != $book['created_at']): ?>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong><i class="fas fa-edit"></i> Terakhir Diupdate:</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <?= date('d F Y H:i', strtotime($book['updated_at'])) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if (!empty($book['sinopsis'])): ?>
                        <hr>
                        <div class="mt-4">
                            <h5><i class="fas fa-align-left"></i> Sinopsis</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="mb-0" style="text-align: justify; line-height: 1.6;">
                                        <?= nl2br(esc($book['sinopsis'])) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url('/books') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <div class="btn-group" role="group">
                            <a href="<?= base_url('/books?search=' . urlencode($book['kategori'])) ?>" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-list"></i> Buku Serupa
                            </a>
                            <a href="<?= base_url('/books?search=' . urlencode($book['penulis'])) ?>" 
                               class="btn btn-outline-info btn-sm">
                                <i class="fas fa-user"></i> Karya Penulis
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>