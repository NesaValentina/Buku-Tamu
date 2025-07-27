<?php

/**
 * Model untuk tabel books - Perpustakaan Digital
 * Mengatur operasi CRUD dan pencarian buku
 */

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul_buku', 
        'penulis', 
        'penerbit', 
        'tahun_terbit', 
        'kategori', 
        'sinopsis'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'judul_buku'   => 'required|min_length[3]|max_length[255]',
        'penulis'      => 'required|min_length[3]|max_length[255]',
        'penerbit'     => 'required|min_length[3]|max_length[255]',
        'tahun_terbit' => 'required|integer|greater_than[1900]|less_than_equal_to[' . date('Y') . ']',
        'kategori'     => 'required|min_length[3]|max_length[100]',
        'sinopsis'     => 'permit_empty'
    ];
    
    protected $validationMessages = [
        'judul_buku' => [
            'required' => 'Judul buku harus diisi',
            'min_length' => 'Judul buku minimal 3 karakter',
            'max_length' => 'Judul buku maksimal 255 karakter'
        ],
        'penulis' => [
            'required' => 'Penulis harus diisi',
            'min_length' => 'Nama penulis minimal 3 karakter'
        ],
        'penerbit' => [
            'required' => 'Penerbit harus diisi',
            'min_length' => 'Nama penerbit minimal 3 karakter'
        ],
        'tahun_terbit' => [
            'required' => 'Tahun terbit harus diisi',
            'integer' => 'Tahun terbit harus berupa angka',
            'greater_than' => 'Tahun terbit tidak valid',
            'less_than_equal_to' => 'Tahun terbit tidak boleh lebih dari tahun sekarang'
        ],
        'kategori' => [
            'required' => 'Kategori harus diisi',
            'min_length' => 'Kategori minimal 3 karakter'
        ]
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Pencarian buku berdasarkan judul
     */
    public function searchBooks($keyword, $limit = 10, $offset = 0)
    {
        return $this->like('judul_buku', $keyword)
                    ->orLike('penulis', $keyword)
                    ->orLike('kategori', $keyword)
                    ->limit($limit, $offset)
                    ->findAll();
    }

    /**
     * Hitung total hasil pencarian
     */
    public function countSearchResults($keyword)
    {
        return $this->like('judul_buku', $keyword)
                    ->orLike('penulis', $keyword)
                    ->orLike('kategori', $keyword)
                    ->countAllResults();
    }

    /**
     * Get books dengan pagination
     */
    public function getBooksWithPagination($limit = 10, $offset = 0)
    {
        return $this->limit($limit, $offset)
                    ->orderBy('created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Get semua kategori unik
     */
    public function getCategories()
    {
        return $this->select('kategori')
                    ->distinct()
                    ->orderBy('kategori', 'ASC')
                    ->findAll();
    }
}
