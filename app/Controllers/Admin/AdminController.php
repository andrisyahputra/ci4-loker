<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Admin;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        //

        $totalLoker = $this->db->table("lokers")->countAllResults();
        $totalKategori = $this->db->table("kategoris")->countAllResults();
        $totalAdmin = $this->db->table("admins")->countAllResults();
        $totalLamar = $this->db->table("applylokers")->countAllResults();
        return view('admin/dashboard', compact('totalLoker', 'totalKategori', 'totalAdmin', 'totalLamar'));
    }
    public function login()
    {
        //
        return view('admin/login');
    }
    public function checkLogin()
    {
        //
        $session = session();
        $user_model = new Admin();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('login')['password'];

        $data = $user_model->where('email', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $cek_pass = password_verify($password, $pass);
            if ($cek_pass) {

                $ses_data = [
                    'id' => $data['id'],
                    'nama' => $data['nama'],
                    'email' => $data['email'],
                    'isLoggedIn' => true,
                ];
                $session->set($ses_data);
                return redirect()->to(url_to('admin.index'));
            } else {
                $session->setFlashdata('error', 'Password Salah');
                return redirect()->to(base_url('admin/login'));
            }
        } else {
            $session->setFlashdata('error', 'Akun tidak Ada');
            return redirect()->to(base_url(relativePath: 'admin/login'));
        }
    }
    public function logout()
    {
        $session = session();
        $ses_data = [
            'id' => "",
            'nama' => "",
            'email' => "",
            'isLoggedIn' => false,
        ];
        $session->set($ses_data);
        $session->setFlashdata('success', 'Berhasil Logout');
        return redirect()->to(url_to('admin.login'));


    }
    public function displayAdmin()
    {
        //
        $judul = 'Halaman Admin';
        $session = session();
        $admin = new Admin();
        $allAdmins = $admin->findAll();
        return view('admin/admins/all-admin', compact('allAdmins', 'judul'));
    }
    public function tambahAdmin()
    {
        //
        $judul = 'Tambah Admin';
        // $session = session();
        // $admin = new Admin();
        // $allAdmins = $admin->findAll();
        return view('admin/admins/tambah-admin', compact('judul'));
    }
    public function storeAdmin()
    {
        $admin = new Admin();
        $data = [
            "email" => $this->request->getPost('email'),
            "password" => $this->request->getPost('password'),
            "nama" => $this->request->getPost('nama'),
            // "loker_id" => $id,
            // "loker_id" => $this->request->getPost('id')
        ];
        $admin->save($data);
        if ($admin) {
            return redirect()->to(url_to('loker.detail', $id))->with('success', 'Berhasil Di simpan');
        }

        return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }

}