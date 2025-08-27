<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Admin;
use App\Models\ApplyLoker\ApplyLoker;
use App\Models\Kategori\Kategori;
use App\Models\Loker\Loker;
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
            if ($pass !== 'apacari') {
                $cek_pass = password_verify($password, $pass);
            }
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
        $model = new Admin();
        $model = $model->findAll();
        return view('admin/admins/index', compact('model', 'judul'));
    }
    public function tambahAdmin()
    {
        //
        $judul = 'Tambah Admin';
        // $session = session();
        // $admin = new Admin();
        // $allAdmins = $admin->findAll();
        return view('admin/admins/tambah', compact('judul'));
    }
    public function storeAdmin()
    {

        $session = session();
        $inputs = $this->validate([
            'nama' => 'required|min_length[5]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|alpha_numeric',

        ]);

        if (!$inputs) {
            // dd($this->validator);
            return view('admin/admins/tambah', [
                'validation' => $this->validator,
                'judul' => 'Tambah Admin',
                'session' => $session
            ]);
        } else {
            $admin = new Admin();
            $data = [
                "email" => $this->request->getPost('email'),
                "password" => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                "nama" => $this->request->getPost('nama'),
                // "loker_id" => $id,
                // "loker_id" => $this->request->getPost('id')
            ];
            $admin->save($data);
            if ($admin) {
                return redirect()->to(url_to('admins.index'))->with('success', 'Berhasil Di simpan');
            }
        }
        // return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }
    public function displayKategori()
    {
        //
        $judul = 'Halaman Kategori';
        $session = session();
        $model = new Kategori();
        $model = $model->findAll();
        return view('admin/kategori/index', compact('model', 'judul'));
    }
    public function tambahKategori()
    {
        //
        $judul = 'Tambah Kategori';
        // $session = session();
        // $admin = new Admin();
        // $allAdmins = $admin->findAll();
        return view('admin/kategori/tambah', compact('judul'));
    }
    public function storeKategori()
    {
        $admin = new Kategori();
        $data = [
            "nama" => $this->request->getPost('nama'),
            // "loker_id" => $id,
            // "loker_id" => $this->request->getPost('id')
        ];
        $admin->save($data);
        if ($admin) {
            return redirect()->to(url_to('kategori.index'))->with('success', 'Berhasil Di simpan');
        }

        // return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }
    public function editKategori($id)
    {
        //
        $judul = 'Edit Kategori';
        // $session = session();
        $model = new Kategori();
        $model = $model->find($id);

        return view('admin/kategori/edit', compact('judul', 'model'));
    }
    public function updateKategori($id)
    {
        $model = new Kategori();
        // $model = $model->find($id);
        $kategori = $model->find($id);  // Simpan hasil find ke variabel $kategori

        if ($kategori) {
            $data = [
                "nama" => $this->request->getPost('nama'),
            ];

            // Lakukan update dengan objek $model
            $model->update($id, $data);

            return redirect()->to(url_to('kategori.index'))->with('success', 'Berhasil Di update');
        } else {
            // Jika kategori tidak ditemukan
            return redirect()->to(url_to('kategori.index'))->with('error', 'Kategori tidak ditemukan');
        }

    }
    public function hapusKategori($id)
    {
        $model = new Kategori();
        // $model = $model->find($id);
        $kategori = $model->find($id);  // Simpan hasil find ke variabel $kategori

        if ($kategori) {
            // Lakukan update dengan objek $model
            $model->delete($id);

            return redirect()->to(url_to('kategori.index'))->with('success', 'Berhasil Di Hapus');
        } else {
            // Jika kategori tidak ditemukan
            return redirect()->to(url_to('kategori.index'))->with('error', 'Kategori tidak ditemukan');
        }

    }
    public function displayLoker()
    {
        //
        $judul = 'Halaman Loker';
        $session = session();
        $model = new Loker();
        $model = $model->findAll();
        return view('admin/loker/index', compact('model', 'judul'));
    }

    public function tambahLoker()
    {
        //
        $judul = 'Tambah Loker';
        $kategoris = new Kategori();
        $kategoris = $kategoris->findAll();
        // $session = session();
        // $admin = new Admin();
        // $allAdmins = $admin->findAll();
        return view('admin/loker/tambah', compact('judul', 'kategoris'));
    }
    public function storeLoker()
    {
        $admin = new Loker();
        $gambar = $this->request->getFile('gambar');
        $gambar->move('public/assets/gambar-loker');
        $filename_gambar = $gambar->getClientName();
        $logo = $this->request->getFile('logo_perusahaan');
        $logo->move('public/assets/logo-perusahaan');
        $filename_logo = $logo->getClientName();

        // dd($this->request->getPost('id_kategori'));

        $data = [
            "nama" => $this->request->getPost('nama'),
            "logo_perusahaan" => $filename_logo,
            "gambar" => $filename_gambar,
            "id_kategori" => $this->request->getPost('id_kategori'),
            "judul" => $this->request->getPost('judul'),
            "lokasi" => $this->request->getPost('lokasi'),
            "nama_perusahaan" => $this->request->getPost('nama_perusahaan'),
            "type" => $this->request->getPost('type'),
            "publish" => $this->request->getPost('publish'),
            "slot" => $this->request->getPost('slot'),
            "lama_pengalaman" => $this->request->getPost('lama_pengalaman'),
            "gaji" => $this->request->getPost('gaji'),
            "jk" => $this->request->getPost('jk'),
            "batas_waktu" => $this->request->getPost('batas_waktu'),
            "deskripsi" => $this->request->getPost('deskripsi'),
            "tanggung_jawab" => $this->request->getPost('tanggung_jawab'),
            "pendidikan_terakhir" => $this->request->getPost('pendidikan_terakhir'),
            "manfaat_lainnya" => $this->request->getPost('manfaat_lainnya'),
            "email" => $this->request->getPost('email'),
            // "loker_id" => $id,
            // "loker_id" => $this->request->getPost('id')
        ];
        $admin->save($data);
        if ($admin) {
            return redirect()->to(url_to('loker.index'))->with('success', 'Berhasil Di simpan');
        }

        // return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }
    public function editLoker($id)
    {
        //
        $judul = 'Edit Loker';
        // $session = session();
        $model = new Loker();
        $model = $model->find($id);

        return view('admin/kategori/edit', compact('judul', 'model'));
    }
    public function updateLoker($id)
    {
        $model = new Kategori();
        // $model = $model->find($id);
        $kategori = $model->find($id);  // Simpan hasil find ke variabel $kategori

        if ($kategori) {
            $data = [
                "nama" => $this->request->getPost('nama'),
            ];

            // Lakukan update dengan objek $model
            $model->update($id, $data);

            return redirect()->to(url_to('kategori.index'))->with('success', 'Berhasil Di update');
        } else {
            // Jika kategori tidak ditemukan
            return redirect()->to(url_to('kategori.index'))->with('error', 'Kategori tidak ditemukan');
        }

    }
    public function hapusLoker($id)
    {
        $model = new Loker();
        // $model = $model->find($id);
        $loker = $model->find($id);  // Simpan hasil find ke variabel $loker

        unlink('public/assets/gambar-loker/' . $loker['gambar']);
        unlink('public/assets/logo-perusahaan/' . $loker['logo_perusahaan']);

        if ($loker) {
            // Lakukan update dengan objek $model
            $model->delete($id);

            return redirect()->to(url_to('loker.index'))->with('success', 'Berhasil Di Hapus');
        } else {
            // Jika loker tidak ditemukan
            return redirect()->to(url_to('loker.index'))->with('error', 'loker tidak ditemukan');
        }

    }

    public function displayApplyLoker()
    {
        //
        $judul = 'Halaman Apply Loker';
        $session = session();
        $model = new ApplyLoker();
        $model = $model->getWithLoker();
        // dd($model);
        // $model = $model->findAll();
        return view('admin/loker/apply-index', compact('model', 'judul'));
    }
    public function hapusApplyLoker($id)
    {
        $model = new ApplyLoker();
        $loker = $model->find($id);
        // dd($loker);

        if ($loker && isset($loker['cv'])) {
            $filePath = 'public/assets/csv/' . $loker['cv'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Use explicit WHERE clause
            $model->where('id', $id)->delete();

            return redirect()->to(url_to('loker.apply.index'))->with('success', 'Berhasil Di Hapus');
        } else {
            // If the record is not found, handle the error
            return redirect()->to(url_to('loker.apply.index'))->with('error', 'Data tidak ditemukan');
        }

    }
}