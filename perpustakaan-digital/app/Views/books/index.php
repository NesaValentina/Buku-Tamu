<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-books"></i> Daftar Buku</h2>
            <p class="text-muted">
                <?php if ($keyword): ?>
                    Hasil pencarian untuk: <strong>"<?= esc($keyword) ?>"</strong> 
                    (<?= $total ?> buku ditemukan)
                <?php else: ?>
                    Total <?= $total ?> buku tersedia di perpustakaan
                <?php endif; ?>
            </p>
        </div>
        <div class="col-md-4 text-end">
            <?php if (session()->get('admin_logged_in')): ?>
                <a href="<?= base_url('/books/create') ?>" class="btn btn-success">
                    <i class="fas fa-plus"></i> Tambah Buku
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <form action="<?= base_url('/books') ?>" method="GET">
                <div class="input-group">
                    <input type="text" 
                           class="form-control" 
                           name="search" 
                           value="<?= esc($keyword) ?>"
                           placeholder="Cari berdasarkan judul, penulis, atau kategori...">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <?php if ($keyword): ?>
                        <a href="<?= base_url('/books') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Reset
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Books List -->
    <?php if (!empty($books)): ?>
        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card book-card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <?= esc($book['judul_buku']) ?>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-user"></i> <?= esc($book['penulis']) ?>
                            </h6>
                            <p class="text-muted mb-2">
                                <small>
                                    <i class="fas fa-building"></i> <?= esc($book['penerbit']) ?>
                                    <span class="ms-2">
                                        <i class="fas fa-calendar"></i> <?= esc($book['tahun_terbit']) ?>
                                    </span>
                                </small>
                            </p>
                            <span class="badge bg-secondary mb-3">
                                <i class="fas fa-tag"></i> <?= esc($book['kategori']) ?>
                            </span>
                            
                            <?php if (!empty($book['sinopsis'])): ?>
                                <p class="card-text">
                                    <?= esc(substr($book['sinopsis'], 0, 120)) ?>
                                    <?= strlen($book['sinopsis']) > 120 ? '...' : '' ?>
                                </p>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="<?= base_url('/books/show/' . $book['id_buku']) ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                
                                <?php if (session()->get('admin_logged_in')): ?>
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('/books/edit/' . $book['id_buku']) ?>" 
                                           class="btn btn-outline-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-danger btn-sm"
                                                onclick="confirmDelete('<?= base_url('/books/delete/' . $book['id_buku']) ?>', 'Hapus buku ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($pager): ?>
            <div class="row mt-4">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <?= $pager ?>
                    </nav>
                </div>
            </div>
        <?php endif; ?>

    <?php else: ?>
        <div class="row">
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">
                        <?php if ($keyword): ?>
                            Tidak ada buku yang ditemukan
                        <?php else: ?>
                            Belum ada buku tersedia
                        <?php endif; ?>
                    </h4>
                    <p class="text-muted">
                        <?php if ($keyword): ?>
                            Coba gunakan kata kunci yang berbeda
                        <?php else: ?>
                            <?php if (session()->get('admin_logged_in')): ?>
                                <a href="<?= base_url('/books/create') ?>" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Buku Pertama
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>