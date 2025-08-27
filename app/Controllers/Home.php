<?php

namespace App\Controllers;
use App\Models\Loker\Loker;
use App\Models\Search\Search;

class Home extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function index(): string
    {
        $loker = new Loker();
        $allloker = $loker->findAll();
        $totalLoker = $this->db->table("lokers")->countAllResults();
        $searches = $this->db->query('SELECT COUNT(*)  AS count, keyword FROM searches GROUP BY keyword ORDER BY count DESC LIMIT 4')->getResult();
        return view('home', compact('allloker', 'totalLoker', 'searches'));
    }
    public function contact(): string
    {
        $loker = new Loker();
        $allloker = $loker->findAll();
        $totalLoker = $this->db->table("lokers")->countAllResults();
        return view('pages/contact', compact('allloker', 'totalLoker'));
    }
    public function about(): string
    {
        $loker = new Loker();
        $allloker = $loker->findAll();
        $totalLoker = $this->db->table("lokers")->countAllResults();
        return view('pages/about', compact('allloker', 'totalLoker'));
    }

    // public function storeSearch()
    // {
    //     $admin = new Search();
    //     $data = [
    //         "keyword" => $this->request->getPost('title'),
    //         // "loker_id" => $id,
    //         // "loker_id" => $this->request->getPost('id')
    //     ];
    //     $admin->save($data);
    //     if ($admin) {
    //         return redirect()->to(url_to('kategori.index'))->with('success', 'Berhasil Di simpan');
    //     }

    //     // return view("loker/detail-kategori", compact("allloker", "totalLoker", "model"));
    // }
}