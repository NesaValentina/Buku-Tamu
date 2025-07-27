<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4 mb-4">
            <i class="fas fa-book-open"></i> Selamat Datang di Perpustakaan Digital
        </h1>
        <p class="lead mb-4">
            Temukan ribuan koleksi buku digital yang dapat Anda akses kapan saja, di mana saja
        </p>
        <div class="row justify-content-center mb-4">
            <div class="col-md-4">
                <div class="card bg-transparent border-light text-white">
                    <div class="card-body">
                        <h3><i class="fas fa-books"></i> <?= $total_books ?></h3>
                        <p>Total Buku</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-transparent border-light text-white">
                    <div class="card-body">
                        <h3><i class="fas fa-list"></i> <?= count($categories) ?></h3>
                        <p>Kategori</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="<?= base_url('/books') ?>" class="btn btn-light btn-lg">
            <i class="fas fa-search"></i> Jelajahi Koleksi
        </a>
    </div>
</section>

<!-- Search Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="text-center mb-4">Cari Buku</h2>
                <form action="<?= base_url('/books') ?>" method="GET">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" name="search" 
                               placeholder="Masukkan judul buku, penulis, atau kategori...">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Latest Books Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">
            <i class="fas fa-star"></i> Buku Terbaru
        </h2>
        
        <?php if (!empty($latest_books)): ?>
            <div class="row">
                <?php foreach ($latest_books as $book): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card book-card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title text-primary">
                                    <?= esc($book['judul_buku']) ?>
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-user"></i> <?= esc($book['penulis']) ?>
                                </h6>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-building"></i> <?= esc($book['penerbit']) ?>
                                    <span class="ms-2">
                                        <i class="fas fa-calendar"></i> <?= esc($book['tahun_terbit']) ?>
                                    </span>
                                </p>
                                <span class="badge bg-secondary mb-3">
                                    <i class="fas fa-tag"></i> <?= esc($book['kategori']) ?>
                                </span>
                                <p class="card-text">
                                    <?= esc(substr($book['sinopsis'] ?? 'Tidak ada sinopsis tersedia.', 0, 100)) ?>...
                                </p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="<?= base_url('/books/show/' . $book['id_buku']) ?>" 
                                   class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="text-center mt-4">
                <a href="<?= base_url('/books') ?>" class="btn btn-primary">
                    <i class="fas fa-books"></i> Lihat Semua Buku
                </a>
            </div>
        <?php else: ?>
            <div class="text-center">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Belum ada buku yang tersedia.
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Categories Section -->
<?php if (!empty($categories)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">
            <i class="fas fa-list"></i> Kategori Buku
        </h2>
        <div class="row">
            <?php foreach ($categories as $category): ?>
                <div class="col-md-3 col-sm-6 mb-3">
                    <div class="card text-center h-100">
                        <div class="card-body">
                            <i class="fas fa-folder-open fa-2x text-primary mb-3"></i>
                            <h6 class="card-title"><?= esc($category['kategori']) ?></h6>
                            <a href="<?= base_url('/books?search=' . urlencode($category['kategori'])) ?>" 
                               class="btn btn-sm btn-outline-primary">
                                Lihat Buku
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Features Section -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">
            <i class="fas fa-star"></i> Mengapa Memilih Kami?
        </h2>
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <div class="card h-100 border-0">
                    <div class="card-body">
                        <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                        <h5>Akses 24/7</h5>
                        <p>Akses koleksi buku kapan saja, di mana saja tanpa batas waktu.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="card h-100 border-0">
                    <div class="card-body">
                        <i class="fas fa-search fa-3x text-primary mb-3"></i>
                        <h5>Pencarian Mudah</h5>
                        <p>Temukan buku yang Anda inginkan dengan fitur pencarian yang canggih.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center mb-4">
                <div class="card h-100 border-0">
                    <div class="card-body">
                        <i class="fas fa-mobile-alt fa-3x text-primary mb-3"></i>
                        <h5>Responsif</h5>
                        <p>Tampilan yang optimal di semua perangkat, desktop maupun mobile.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>