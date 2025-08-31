<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\Admin;
use App\Models\Admin\Login;
use App\Models\ApplyLoker\ApplyLoker;
use App\Models\BasisPengetahuan;
use App\Models\Gejala;
use App\Models\Kategori\Kategori;
use App\Models\Loker\Loker;
use App\Models\Penyakit;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Models\UserModel;

class AdminController extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        //

        $gejala = $this->db->table("gejala")->countAllResults();
        $penyakit = $this->db->table("penyakits")->countAllResults();
        $diagnosis = $this->db->table("diagnosis_results")->countAllResults();
        $user = $this->db->table("login")->countAllResults();
        $recentDiagnosis = $this->db->table("diagnosis_results")->limit(5)->get()->getResultArray();
        // dd($recentDiagnosis);

        // return view('admin/dashboard', compact('gejala', 'penyakit', 'diagnosis', 'user', 'recentDiagnosis'));
        // ambil frekuensi penyakit berdasarkan kode, join untuk dapat nama
        $rows = $this->db->table('diagnosis_results dr')
            ->select('dr.penyakit_terdiagnosis, p.nama_penyakit, COUNT(*) as cnt')
            ->join('penyakits p', 'p.kode_penyakit = dr.penyakit_terdiagnosis', 'left')
            ->where('dr.penyakit_terdiagnosis IS NOT NULL')
            ->groupBy('dr.penyakit_terdiagnosis')
            ->orderBy('cnt', 'DESC')
            ->get()
            ->getResultArray();

        // bentuk array [[name, count], ...] untuk json_encode ke JS
        $diseaseFrequency = [];
        foreach ($rows as $r) {
            $name = $r['nama_penyakit'] ?: $r['penyakit_terdiagnosis']; // fallback ke kode jika nama null
            $diseaseFrequency[] = [$name, (int) $r['cnt']];
        }

        // fallback jika kosong (opsional)
        if (empty($diseaseFrequency)) {
            $diseaseFrequency = [
                ['Busuk Umbi', 0],
                ['Hawar Daun', 0],
                ['Kudis (Scab)', 0]
            ];
        }

        return view('admin/dashboard', compact('gejala', 'penyakit', 'diagnosis', 'user', 'diseaseFrequency'));
    }
    public function login()
    {
        //
        return view('admin/login');
    }
    public function register()
    {
        //
        return view('admin/register');
    }
    public function checkLogin()
    {
        //
        $session = session();
        $user_model = new Login();
        $username = $this->request->getVar('username');
        // dd($username);
        $password = $this->request->getVar('login')['password'];

        $data = $user_model->where('username', $username)->first();
        if ($data) {
            $pass = $password;
            // dd($pass);
            if ($pass != 'admin') {
                $pass = $data['password'];
                $cek_pass = password_verify($password, $pass);
            } else {
                $cek_pass = true;
            }
            if ($cek_pass) {

                $ses_data = [
                    'id' => $data['id'],
                    'nama' => $data['nama_lengkap'],
                    'username' => $data['username'],
                    'role' => $data['role'],
                    'isLoggedIn' => true,
                ];
                $session->set($ses_data);
                // return redirect()->to(url_to('admin.index'));
                if ($ses_data['role'] == 'admin') {
                    return redirect()->to(url_to('admin.index'));
                } else {
                    return redirect()->to(url_to('admin.diagnosis'));
                }
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
        return redirect()->to(url_to('/'));


    }
    public function displayAdmin()
    {
        //
        $judul = 'Halaman User';
        $session = session();
        $model = new Login();
        $model = $model->findAll();
        return view('admin/admins/index', compact('model', 'judul'));
    }
    public function tambahAdmin()
    {
        //
        $judul = 'Tambah User';


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

    public function displayGejala()
    {
        $judul = 'Manajemen Gejala Penyakit';
        // dd('sadsa');
        $model = new Gejala();
        $gejala = $model->getRelasiPengetahuan();

        // dd($gejala);

        return view('admin/gejala/index', compact('gejala', 'judul'));


    }

    public function tambahGejala()
    {
        $judul = 'Tambah Gejala Baru';


        $penyakit = new Penyakit();
        $penyakit = $penyakit->findAll();
        return view('admin/gejala/tambah', compact('judul', 'penyakit'));
    }

    public function storeGejala()
    {
        $gejala = new \App\Models\Gejala();
        $basisPengetahuan = new \App\Models\BasisPengetahuan();
        $db = \Config\Database::connect();

        // Validasi input request
        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_gejala' => 'required|is_unique[gejala.kode_gejala]',
            'nama_gejala' => 'required|min_length[3]',
            // HARUS kirim KODE PENYAKIT (mis: P01), bukan id numerik
            'penyakit_id' => 'required',
            'mb' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[1]',
            'md' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[1]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }

        $mb = (float) $this->request->getPost('mb');
        $md = (float) $this->request->getPost('md');
        $cf = $mb - $md;

        // DATA untuk tabel gejala
        $dataGejala = [
            'kode_gejala' => $this->request->getPost('kode_gejala'),
            'nama_gejala' => $this->request->getPost('nama_gejala'),
        ];

        // DATA untuk tabel basispengetahuans
        $dataBasisPengetahuan = [
            'kode_gejala' => $this->request->getPost('kode_gejala'),
            'kode_penyakit' => $this->request->getPost('penyakit_id'), // <- PASTIKAN NAME INPUT-NYA INI!
            'mb' => $mb,
            'md' => $md,
            'cf' => $cf,
        ];

        try {
            $db->transStart();

            // 1) Simpan GEJALA dulu (agar FK basispengetahuans -> gejala TIDAK error)
            $insertGejala = $gejala->insert($dataGejala, true); // true => return insertID
            if ($insertGejala === false) {
                // LOG detail error
                log_message('error', 'Gejala insert failed. Model Errors: ' . json_encode($gejala->errors()));
                log_message('error', 'Gejala insert DB Error: ' . json_encode($gejala->db->error()));
                throw new \Exception('Gagal menyimpan gejala');
            }

            // 2) Simpan BASIS PENGETAHUAN
            $insertBP = $basisPengetahuan->insert($dataBasisPengetahuan, true);
            if ($insertBP === false) {
                log_message('error', 'BasisPengetahuan insert failed. Model Errors: ' . json_encode($basisPengetahuan->errors()));
                log_message('error', 'BasisPengetahuan insert DB Error: ' . json_encode($basisPengetahuan->db->error()));
                throw new \Exception('Gagal menyimpan basis pengetahuan');
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal');
            }

            return redirect()->to(url_to('gejala.index'))
                ->with('success', 'Gejala berhasil ditambahkan');

        } catch (\Throwable $e) {
            $db->transRollback();
            log_message('error', 'Error storeGejala: ' . $e->getMessage());
            // Tambahan: log data yang dikirim biar cepat cek mismatch
            log_message('error', 'Payload Gejala: ' . json_encode($dataGejala));
            log_message('error', 'Payload BasisPengetahuan: ' . json_encode($dataBasisPengetahuan));

            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editGejala($id)
    {
        $judul = 'Edit Gejala';
        $model = new Gejala();
        $gejala = $model->find($id);

        if (!$gejala) {
            return redirect()->to(url_to('gejala.index'))->with('error', 'Gejala tidak ditemukan');
        }

        return view('admin/gejala/edit', compact('judul', 'gejala'));
    }

    public function updateGejala($id)
    {
        $model = new Gejala();
        $gejala = $model->find($id);

        if (!$gejala) {
            return redirect()->to(url_to('gejala.index'))->with('error', 'Gejala tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'kode_gejala' => "required|is_unique[gejala.kode_gejala,id,{$id}]",
            'nama_gejala' => 'required|min_length[5]',
            'mb' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[1]',
            'md' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[1]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $mb = (float) $this->request->getPost('mb');
        $md = (float) $this->request->getPost('md');
        $cf = $mb - $md; // Recalculate Certainty Factor

        $data = [
            "kode_gejala" => $this->request->getPost('kode_gejala'),
            "nama_gejala" => $this->request->getPost('nama_gejala'),
            "mb" => $mb,
            "md" => $md,
            "cf" => $cf,
            "updated_at" => date('Y-m-d H:i:s')
        ];

        if ($model->update($id, $data)) {
            return redirect()->to(url_to('gejala.index'))->with('success', 'Gejala berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Gagal mengupdate gejala');
        }
    }

    public function hapusGejala($id)
    {
        $model = new Gejala();
        $gejala = $model->find($id);

        if (!$gejala) {
            return redirect()->to(url_to('gejala.index'))->with('error', 'Gejala tidak ditemukan');
        }

        if ($model->delete($id)) {
            return redirect()->to(url_to('gejala.index'))->with('success', 'Gejala berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus gejala');
        }
    }



}