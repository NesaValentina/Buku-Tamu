<?php

/**
 * Controller untuk autentikasi admin - Perpustakaan Digital
 * Menangani login dan logout admin
 */

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    protected $adminModel;
    protected $session;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
        $this->session = session();
    }

    /**
     * Halaman login
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('admin_logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'title' => 'Login Admin - Perpustakaan Digital',
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    /**
     * Proses login
     */
    public function processLogin()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $this->adminModel->verifyLogin($username, $password);

        if ($admin) {
            $sessionData = [
                'admin_id' => $admin['id'],
                'admin_username' => $admin['username'],
                'admin_nama' => $admin['nama_lengkap'],
                'admin_logged_in' => true
            ];

            $this->session->set($sessionData);
            
            return redirect()->to('/dashboard')->with('success', 'Login berhasil! Selamat datang ' . $admin['nama_lengkap']);
        } else {
            return redirect()->back()->withInput()->with('error', 'Username atau password salah!');
        }
    }

    /**
     * Logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/')->with('success', 'Anda telah logout');
    }

    /**
     * Cek apakah admin sudah login
     */
    public function isLoggedIn()
    {
        return $this->session->get('admin_logged_in') ? true : false;
    }
}
