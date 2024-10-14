<?php

namespace App\Controllers;
use App\Models\Loker\Loker;

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
        return view('home', compact('allloker', 'totalLoker'));
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
}