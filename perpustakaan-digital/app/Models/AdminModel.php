<?php

/**
 * Model untuk tabel admins - Perpustakaan Digital
 * Mengatur autentikasi dan manajemen admin
 */

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'admins';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username', 
        'password', 
        'email', 
        'nama_lengkap'
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
        'username'     => 'required|min_length[3]|max_length[50]|is_unique[admins.username,id,{id}]',
        'password'     => 'required|min_length[6]',
        'email'        => 'required|valid_email|is_unique[admins.email,id,{id}]',
        'nama_lengkap' => 'required|min_length[3]|max_length[255]'
    ];
    
    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'is_unique' => 'Username sudah digunakan'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'is_unique' => 'Email sudah digunakan'
        ],
        'nama_lengkap' => [
            'required' => 'Nama lengkap harus diisi',
            'min_length' => 'Nama lengkap minimal 3 karakter'
        ]
    ];
    
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['hashPassword'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['hashPassword'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Hash password sebelum disimpan
     */
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    /**
     * Verifikasi login admin
     */
    public function verifyLogin($username, $password)
    {
        $admin = $this->where('username', $username)->first();
        
        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        
        return false;
    }

    /**
     * Cek apakah username sudah ada
     */
    public function isUsernameExists($username, $excludeId = null)
    {
        $query = $this->where('username', $username);
        
        if ($excludeId) {
            $query->where('id !=', $excludeId);
        }
        
        return $query->first() ? true : false;
    }
}
