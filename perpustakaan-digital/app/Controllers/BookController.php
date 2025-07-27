<?php

/**
 * Controller untuk manajemen buku - Perpustakaan Digital
 * Menangani CRUD, pencarian, dan pagination buku
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BookModel;
use CodeIgniter\HTTP\ResponseInterface;

class BookController extends BaseController
{
    protected $bookModel;
    protected $session;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        $this->session = session();
    }

    /**
     * Halaman daftar buku dengan pagination dan search
     */
    public function index()
    {
        $perPage = 10;
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
            'title' => 'Daftar Buku - Perpustakaan Digital',
            'books' => $books,
            'pager' => $pager->makeLinks($pager->getCurrentPage(), $perPage, $total, 'default_full'),
            'keyword' => $keyword,
            'total' => $total
        ];

        return view('books/index', $data);
    }

    /**
     * Halaman tambah buku (hanya admin)
     */
    public function create()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'title' => 'Tambah Buku - Perpustakaan Digital',
            'validation' => \Config\Services::validation()
        ];

        return view('books/create', $data);
    }

    /**
     * Proses simpan buku baru
     */
    public function store()
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'kategori' => $this->request->getPost('kategori'),
            'sinopsis' => $this->request->getPost('sinopsis'),
        ];

        if ($this->bookModel->save($data)) {
            return redirect()->to('/books')->with('success', 'Buku berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->bookModel->errors());
        }
    }

    /**
     * Halaman detail buku
     */
    public function show($id)
    {
        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        $data = [
            'title' => $book['judul_buku'] . ' - Perpustakaan Digital',
            'book' => $book
        ];

        return view('books/show', $data);
    }

    /**
     * Halaman edit buku (hanya admin)
     */
    public function edit($id)
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Buku - Perpustakaan Digital',
            'book' => $book,
            'validation' => \Config\Services::validation()
        ];

        return view('books/edit', $data);
    }

    /**
     * Proses update buku
     */
    public function update($id)
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $book = $this->bookModel->find($id);
        
        if (!$book) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku tidak ditemukan');
        }

        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'penulis' => $this->request->getPost('penulis'),
            'penerbit' => $this->request->getPost('penerbit'),
            'tahun_terbit' => $this->request->getPost('tahun_terbit'),
            'kategori' => $this->request->getPost('kategori'),
            'sinopsis' => $this->request->getPost('sinopsis'),
        ];

        if ($this->bookModel->update($id, $data)) {
            return redirect()->to('/books')->with('success', 'Buku berhasil diupdate!');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->bookModel->errors());
        }
    }

    /**
     * Hapus buku
     */
    public function delete($id)
    {
        if (!$this->session->get('admin_logged_in')) {
            return redirect()->to('/auth/login');
        }

        $book = $this->bookModel->find($id);
        
        if (!$book) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        if ($this->bookModel->delete($id)) {
            return redirect()->to('/books')->with('success', 'Buku berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus buku');
        }
    }
}
