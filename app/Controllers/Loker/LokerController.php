<?php

namespace App\Controllers\Loker;

use App\Controllers\BaseController;
use App\Models\ApplyLoker\ApplyLoker;
use App\Models\Kategori\Kategori;
use App\Models\Loker\Loker;
use App\Models\SaveLoker\SaveLoker;
use App\Models\Search\Search;
use CodeIgniter\HTTP\ResponseInterface;

class LokerController extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function detail($id)
    {
        $loker = new Loker;
        $kategori = new Kategori;
        $model = $loker->find($id);

        $relatedLoker = $this->db->query("SELECT * FROM lokers WHERE id != '$id' AND id_kategori = '$model[id_kategori]' ORDER BY ID DESC LIMIT 5")->getResult();
        // $totalLoker = $this->db->query("SELECT COUNT(*) as total_loker FROM lokers WHERE id != '$id' AND kategori = '$model[kategori]'");
        $totalLoker = $this->db->table("lokers")->where("id!=", $id)->where("id_kategori", $model['id_kategori'])->countAllResults();

        // var_dump($totalLoker);
        // die;
        $allKategori = $kategori->findAll();



        if (!empty(auth()->user()->id)) {
            $cekLoker = $this->db->table("savelokers")->where("user_id", auth()->user()->id)->where("loker_id", $id)->countAllResults();
            $cekApplyLoker = $this->db->table("applylokers")->where("user_id", auth()->user()->id)->where("loker_id", $id)->countAllResults();
        } else {
            $cekLoker = 0;
            $cekApplyLoker = 0;

        }

        return view("loker/detail", compact("model", 'relatedLoker', 'totalLoker', 'allKategori', 'cekLoker', 'cekApplyLoker'));
    }
    public function kategori($id)
    {
        $kategori = new Kategori;
        $model = $kategori->find($id);
        $allloker = $this->db->query("SELECT a.*, b.nama as nama_kategori FROM lokers a JOIN kategoris b ON a.id_kategori= b.id WHERE b.id = '$id' ORDER BY ID DESC")->getResult();

        $totalLoker = $this->db->table("lokers")->where("id_kategori", $id)->countAllResults();

        return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }
    public function saveLoker($id)
    {
        $saveLoker = new SaveLoker();
        $data = [
            "user_id" => auth()->user()->id,
            // "loker_id" => $id,
            "loker_id" => $this->request->getPost('id')
        ];
        $saveLoker->save($data);
        if ($saveLoker) {
            return redirect()->to(url_to('loker.detail', $id))->with('success', 'Berhasil Di simpan');
        }

        return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }
    public function applyLoker($id)
    {
        $applyLoker = new ApplyLoker();
        $data = [
            "user_id" => auth()->user()->id,
            // "loker_id" => $id,
            "loker_id" => $this->request->getPost('id'),
            "cv" => $this->request->getPost('cv'),
            "email" => $this->request->getPost('email')
        ];
        if ($data['cv'] == null or $data['email'] == null) {
            return redirect()->to(url_to('loker.detail', $id))->with('error', 'Data Profile Belum Lengkap');
        } else {
            $applyLoker->save($data);
            return redirect()->to(url_to('loker.detail', $id))->with('success', 'Berhasil Di Apply');
        }

        return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    }
    public function cariLoker()
    {
        $loker = new Loker();

        $judul = $this->request->getPost('judul');
        $lokasi = $this->request->getPost('lokasi');
        $type = $this->request->getPost('type');

        $admin = new Search();
        $data = [
            "keyword" => $this->request->getPost('judul'),
            // "loker_id" => $id,
            // "loker_id" => $this->request->getPost('id')
        ];
        $admin->save($data);

        $search = $loker->like('judul', $judul)
            ->like('lokasi', $lokasi)
            ->like('type', $type)
            ->findAll();

        $totalLoker = $loker->like('judul', $judul)
            ->like('lokasi', $lokasi)
            ->like('type', $type)->countAllResults();
        $cari = $judul;

        return view("loker/cari", compact("search", "totalLoker", "cari"));
    }
}