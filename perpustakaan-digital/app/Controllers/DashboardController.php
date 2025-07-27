<?php

/**
 * Controller untuk dashboard admin - Perpustakaan Digital
 * Menampilkan statistik dan manajemen untuk admin
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    protected $bookModel;
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->adminModel = new AdminModel();
        $this->session = session();
    }

    /**
     * Halaman dashboard admin
     */
    public function index()
    {
        // Cek apakah admin sudah login
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        // Statistik untuk dashboard
        $totalBooks = $this->bookModel->countAll();
        $categories = $this->bookModel->getCategories();
        $totalCategories = count($categories);
        
        // Buku terbaru (5 buku)
        $latestBooks = $this->bookModel->orderBy('created_at', 'DESC')
                                      ->limit(5)
                                      ->findAll();

        // Statistik per kategori
        $categoryStats = [];
        foreach ($categories as $category) {
            $count = $this->bookModel->where('kategori', $category['kategori'])->countAllResults();
            $categoryStats[] = [
                'kategori' => $category['kategori'],
                'jumlah' => $count
            ];
        }

        $data = [
            'title' => 'Dashboard Admin - Perpustakaan Digital',
            'total_books' => $totalBooks,
            'total_categories' => $totalCategories,
            'latest_books' => $latestBooks,
            'category_stats' => $categoryStats,
            'admin_name' => $this->session->get('admin_nama')
        ];

        return view('dashboard/index', $data);
    }

    /**
     * Halaman manajemen buku untuk admin
     */
    public function books()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $perPage = 15;
        $keyword = $this->request->getGet('search');
        
        $pager = \Config\Services::pager();
        
        if ($keyword) {
            $books = $this->bookModel->searchBooks($keyword, $perPage, ($pager->getCurrentPage() - 1) * $perPage);
            $total = $this->bookModel->countSearchResults($keyword);
        } else {
            $books = $this->bookModel->getBooksWithPagination($perPage, ($pager->getCurrentPage() - 1) * $perPage);
            $total = $this->bookModel->countAll();
        }

        $data = [
            'title' => 'Manajemen Buku - Dashboard Admin',
            'books' => $books,
            'pager' => $pager->makeLinks($pager->getCurrentPage(), $perPage, $total, 'default_full'),
            'keyword' => $keyword,
            'total' => $total
        ];

        return view('dashboard/books', $data);
    }

    /**
     * Statistik dalam format JSON untuk chart
     */
    public function chartData()
    {
        if (!$this->session->get('admin_logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthorized']);
        }

        $categories = $this->bookModel->getCategories();
        $chartData = [];

        foreach ($categories as $category) {
            $count = $this->bookModel->where('kategori', $category['kategori'])->countAllResults();
            $chartData[] = [
                'label' => $category['kategori'],
                'data' => $count
            ];
        }

        return $this->response->setJSON($chartData);
    }
}
