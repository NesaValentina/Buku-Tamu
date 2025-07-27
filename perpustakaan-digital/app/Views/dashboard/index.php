<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container mt-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h4>
                            <p class="mb-0">Selamat datang, <?= esc($admin_name) ?>!</p>
                        </div>
                        <div>
                            <i class="fas fa-user-shield fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"><?= $total_books ?></h4>
                            <p class="card-text">Total Buku</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-books fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-success-dark">
                    <a href="<?= base_url('/books') ?>" class="text-white text-decoration-none">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"><?= $total_categories ?></h4>
                            <p class="card-text">Kategori</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-list fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-info-dark">
                    <small><i class="fas fa-info-circle"></i> Jenis kategori buku</small>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="card-title"><?= count($latest_books) ?></h4>
                            <p class="card-text">Buku Terbaru</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-star fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-warning-dark">
                    <a href="<?= base_url('/books/create') ?>" class="text-white text-decoration-none">
                        <i class="fas fa-plus"></i> Tambah Buku
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Chart Section -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-chart-pie"></i> Distribusi Kategori Buku</h5>
                </div>
                <div class="card-body">
                    <canvas id="categoryChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <!-- Category Stats -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5><i class="fas fa-list-ol"></i> Statistik Kategori</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($category_stats)): ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th class="text-end">Jumlah</th>
                                        <th class="text-end">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($category_stats as $stat): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-secondary me-2"></span>
                                                <?= esc($stat['kategori']) ?>
                                            </td>
                                            <td class="text-end">
                                                <strong><?= $stat['jumlah'] ?></strong>
                                            </td>
                                            <td class="text-end">
                                                <?= $total_books > 0 ? round(($stat['jumlah'] / $total_books) * 100, 1) : 0 ?>%
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">Belum ada data kategori.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Books -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="fas fa-clock"></i> Buku Terbaru</h5>
                    <a href="<?= base_url('/dashboard/books') ?>" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-list"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <?php if (!empty($latest_books)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Kategori</th>
                                        <th>Tahun</th>
                                        <th>Ditambahkan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($latest_books as $book): ?>
                                        <tr>
                                            <td>
                                                <strong><?= esc($book['judul_buku']) ?></strong>
                                            </td>
                                            <td><?= esc($book['penulis']) ?></td>
                                            <td>
                                                <span class="badge bg-secondary"><?= esc($book['kategori']) ?></span>
                                            </td>
                                            <td><?= esc($book['tahun_terbit']) ?></td>
                                            <td>
                                                <small class="text-muted">
                                                    <?= date('d/m/Y', strtotime($book['created_at'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="<?= base_url('/books/show/' . $book['id_buku']) ?>" 
                                                       class="btn btn-outline-primary btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
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
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-book fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada buku yang ditambahkan.</p>
                            <a href="<?= base_url('/books/create') ?>" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Buku Pertama
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h5><i class="fas fa-bolt"></i> Aksi Cepat</h5>
                    <div class="btn-group" role="group">
                        <a href="<?= base_url('/books/create') ?>" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Buku
                        </a>
                        <a href="<?= base_url('/books') ?>" class="btn btn-primary">
                            <i class="fas fa-list"></i> Daftar Buku
                        </a>
                        <a href="<?= base_url('/dashboard/books') ?>" class="btn btn-info">
                            <i class="fas fa-cog"></i> Kelola Buku
                        </a>
                        <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
                            <i class="fas fa-home"></i> Lihat Situs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Chart for category distribution
<?php if (!empty($category_stats)): ?>
const ctx = document.getElementById('categoryChart').getContext('2d');
const categoryChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [<?php foreach ($category_stats as $stat): ?>'<?= esc($stat['kategori']) ?>',<?php endforeach; ?>],
        datasets: [{
            data: [<?php foreach ($category_stats as $stat): ?><?= $stat['jumlah'] ?>,<?php endforeach; ?>],
            backgroundColor: [
                '#FF6384',
                '#36A2EB',
                '#FFCE56',
                '#4BC0C0',
                '#9966FF',
                '#FF9F40',
                '#FF6384',
                '#C9CBCF',
                '#4BC0C0'
            ],
            borderWidth: 2,
            borderColor: '#fff'
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
<?php endif; ?>
</script>
<?= $this->endSection() ?>