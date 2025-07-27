<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Perpustakaan Digital' ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        .book-card {
            transition: transform 0.3s;
            height: 100%;
        }
        .book-card:hover {
            transform: translateY(-5px);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 40px 0;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                <i class="fas fa-book"></i> Perpustakaan Digital
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>">
                            <i class="fas fa-home"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/books') ?>">
                            <i class="fas fa-books"></i> Daftar Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/about') ?>">
                            <i class="fas fa-info-circle"></i> Tentang
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <?php if (session()->get('admin_logged_in')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?= session()->get('admin_nama') ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= base_url('/dashboard') ?>">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="<?= base_url('/books/create') ?>">
                                    <i class="fas fa-plus"></i> Tambah Buku
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('/auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('/auth/login') ?>">
                                <i class="fas fa-sign-in-alt"></i> Login Admin
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-book"></i> Perpustakaan Digital</h5>
                    <p>Sistem manajemen perpustakaan digital untuk mengelola koleksi buku secara efisien.</p>
                </div>
                <div class="col-md-6">
                    <h5>Kontak</h5>
                    <p>
                        <i class="fas fa-envelope"></i> info@perpustakaan.com<br>
                        <i class="fas fa-phone"></i> (021) 123-4567<br>
                        <i class="fas fa-map-marker-alt"></i> Jakarta, Indonesia
                    </p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; <?= date('Y') ?> Perpustakaan Digital. Dibuat dengan CodeIgniter 4.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Show Alerts -->
    <script>
        <?php if (session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= session()->getFlashdata('error') ?>',
                showConfirmButton: false,
                timer: 3000
            });
        <?php endif; ?>

        // Konfirmasi hapus
        function confirmDelete(url, title = 'Apakah Anda yakin?') {
            Swal.fire({
                title: title,
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>