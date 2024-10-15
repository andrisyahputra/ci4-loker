<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Admin;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;

class AdminController extends BaseController
{
    public function index()
    {
        //
        return view('admin/dashboard');
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
}