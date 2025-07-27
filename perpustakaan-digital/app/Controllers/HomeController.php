<?php

/**
 * Controller untuk halaman utama - Perpustakaan Digital
 * Menampilkan halaman beranda dengan buku-buku terbaru
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use CodeIgniter\HTTP\ResponseInterface;

class HomeController extends BaseController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
    }

    /**
     * Halaman beranda
     */
    public function index()
    {
        // Ambil 6 buku terbaru untuk ditampilkan di beranda
        $latestBooks = $this->bookModel->orderBy('created_at', 'DESC')
                                      ->limit(6)
                                      ->findAll();

        // Hitung total buku
        $totalBooks = $this->bookModel->countAll();

        // Ambil kategori yang tersedia
        $categories = $this->bookModel->getCategories();

        $data = [
            'title' => 'Perpustakaan Digital',
            'latest_books' => $latestBooks,
            'total_books' => $totalBooks,
            'categories' => $categories
        ];

        return view('home/index', $data);
    }

    /**
     * Halaman tentang perpustakaan
     */
    public function about()
    {
        $data = [
            'title' => 'Tentang Kami - Perpustakaan Digital'
        ];

        return view('home/about', $data);
    }

    /**
     * API endpoint untuk statistik (opsional)
     */
    public function statistics()
    {
        $totalBooks = $this->bookModel->countAll();
        $categories = $this->bookModel->getCategories();
        $totalCategories = count($categories);

        $stats = [
            'total_books' => $totalBooks,
            'total_categories' => $totalCategories,
            'categories' => array_column($categories, 'kategori')
        ];

        return $this->response->setJSON($stats);
    }
}
