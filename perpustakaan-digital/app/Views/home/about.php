<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-info text-white text-center">
                    <h3><i class="fas fa-info-circle"></i> Tentang Perpustakaan Digital</h3>
                </div>
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-book-open fa-5x text-primary mb-3"></i>
                        <h4 class="text-primary">Selamat Datang di Era Digital</h4>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5><i class="fas fa-target"></i> Visi</h5>
                            <p class="text-justify">
                                Menjadi platform perpustakaan digital terdepan yang memberikan akses mudah dan cepat 
                                terhadap koleksi buku berkualitas untuk mendukung pendidikan dan pengembangan 
                                pengetahuan masyarakat.
                            </p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5><i class="fas fa-bullseye"></i> Misi</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Menyediakan sistem manajemen perpustakaan yang modern dan user-friendly
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Memfasilitasi akses informasi dan pengetahuan secara digital
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Mendukung digitalisasi perpustakaan di era teknologi modern
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Memberikan pengalaman browsing dan pencarian buku yang optimal
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5><i class="fas fa-star"></i> Keunggulan</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-search fa-2x text-primary mb-2"></i>
                                            <h6>Pencarian Cepat</h6>
                                            <p class="small text-muted">
                                                Temukan buku dengan mudah menggunakan fitur pencarian berdasarkan 
                                                judul, penulis, atau kategori.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-mobile-alt fa-2x text-primary mb-2"></i>
                                            <h6>Responsive Design</h6>
                                            <p class="small text-muted">
                                                Akses dari perangkat apa pun - desktop, tablet, atau smartphone 
                                                dengan tampilan yang optimal.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                                            <h6>Keamanan Terjamin</h6>
                                            <p class="small text-muted">
                                                Sistem keamanan berlapis dengan enkripsi data dan proteksi 
                                                terhadap serangan cyber.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="card h-100 border-0 bg-light">
                                        <div class="card-body text-center">
                                            <i class="fas fa-cogs fa-2x text-primary mb-2"></i>
                                            <h6>Manajemen Mudah</h6>
                                            <p class="small text-muted">
                                                Panel admin yang intuitif untuk mengelola koleksi buku, 
                                                kategori, dan data perpustakaan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5><i class="fas fa-code"></i> Teknologi</h5>
                            <p class="text-justify">
                                Platform ini dibangun menggunakan teknologi modern dan terpercaya:
                            </p>
                            <div class="row">
                                <div class="col-md-4 text-center mb-3">
                                    <div class="p-3 bg-danger text-white rounded">
                                        <h6>CodeIgniter 4</h6>
                                        <small>PHP Framework</small>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    <div class="p-3 bg-primary text-white rounded">
                                        <h6>MySQL</h6>
                                        <small>Database</small>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center mb-3">
                                    <div class="p-3 bg-purple text-white rounded" style="background-color: #7952b3;">
                                        <h6>Bootstrap 5</h6>
                                        <small>CSS Framework</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <h5><i class="fas fa-users"></i> Tim Pengembang</h5>
                            <p class="text-justify">
                                Aplikasi ini dikembangkan oleh tim developer berpengalaman yang berkomitmen 
                                untuk memberikan solusi teknologi terbaik dalam bidang manajemen perpustakaan digital.
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-info">
                                <h6><i class="fas fa-lightbulb"></i> Saran & Masukan</h6>
                                <p class="mb-0">
                                    Kami selalu terbuka untuk menerima saran dan masukan guna pengembangan 
                                    sistem yang lebih baik. Silakan hubungi kami melalui kontak yang tersedia.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center bg-light">
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">
                        <i class="fas fa-home"></i> Kembali ke Beranda
                    </a>
                    <a href="<?= base_url('/books') ?>" class="btn btn-success">
                        <i class="fas fa-books"></i> Jelajahi Koleksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>