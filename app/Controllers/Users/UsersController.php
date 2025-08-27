<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Models\Kategori\Kategori;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Shield\Entities\User;

class UsersController extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }
    public function publicProfile()
    {
        //
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;
        $relatedLoker = $this->db->query("SELECT * FROM lokers WHERE id = '$id' ORDER BY ID DESC")->getResult();
        return view("users/public-profile", compact("relatedLoker"));
    }
    public function updateProfile()
    {
        //
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;
        $users = $this->db->query("SELECT * FROM users WHERE id = '$id' ORDER BY id DESC")->getFirstRow();
        // return view("users/update-profile", compact("users"));
        return view("users/update-profile", compact("users"));
    }
    public function submitUpdateProfile()
    {
        //
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;
        // dd($id);
        // $nama = $this->request->getPost('nama');
        // $email = $this->request->getPost('email');
        // $fb = $this->request->getPost('fb');
        // $twitter = $this->request->getPost('twitter');
        // $ig = $this->request->getPost('ig');
        // $bio = $this->request->getPost('bio');
        // $type = $this->request->getPost('type');


        //
        // $id = auth()->user()->id;
        $nama = $this->request->getPost('nama');
        $email = $this->request->getPost('email');
        $fb = $this->request->getPost('fb');
        $twitter = $this->request->getPost('twitter');
        $ig = $this->request->getPost('ig');
        $bio = $this->request->getPost('bio');
        $type = $this->request->getPost('type');
        $updateUsers = $this->db->query("UPDATE users SET 
            nama = '$nama',
            `type` = '$type',
            email = '$email',
            fb = '$fb',
            twitter = '$twitter',
            ig = '$ig',
            bio = '$bio'
         WHERE id = '$id'");
        if ($updateUsers) {
            return redirect()->to(url_to('users.public.profile'))->with('success', 'Berhasil Di Update');
        }
    }
    public function updateCV()
    {
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        return view('users/update-cv');

    }
    public function submitUpdateCV()
    {
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;

        // $user = new User
        $user = $this->db->query("SELECT * FROM users WHERE id = '$id' ORDER BY id DESC")->getFirstRow();
        if ($user) {
            // dd($user->cv);
            $filePath = 'public/assets/cvs/' . $user->cv;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }


        $img = $this->request->getFile('cv');
        // dd($img); 
        $img->move('public/assets/cvs');

        $fileName = $img->getClientName();


        $updateUsers = $this->db->query("UPDATE users SET 
            cv = '$fileName'
         WHERE id = $id");


        if ($updateUsers) {
            return redirect()->to(url_to('users.public.profile'))->with('success', 'CV Berhasil Di Update');
        }

    }
    public function usersSaveloker()
    {
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;
        // $allloker = $this->db->query("SELECT * FROM savelokers WHERE user_id = '$id' ORDER BY id DESC")->getResult();
        // $kategori = new Kategori;
        // $model = $kategori->find($id);
        $allloker = $this->db->query("SELECT a.* FROM lokers a JOIN savelokers b ON a.id= b.user_id WHERE b.user_id = '$id' ORDER BY ID DESC")->getResult();

        $totalLoker = $this->db->table("savelokers")->where("user_id", $id)->countAllResults();
        // return view("users/update-profile", compact("users"));
        return view("users/save-loker", compact("allloker", "totalLoker"));

    }
    public function usersApllyloker()
    {
        if (empty(auth()->user()->id)) {
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;
        // $allloker = $this->db->query("SELECT * FROM savelokers WHERE user_id = '$id' ORDER BY id DESC")->getResult();
        // $kategori = new Kategori;
        // $model = $kategori->find($id);
        $allloker = $this->db->query("SELECT a.* FROM lokers a JOIN applylokers b ON a.id= b.user_id WHERE b.user_id = '$id' ORDER BY ID DESC")->getResult();

        $totalLoker = $this->db->table("savelokers")->where("user_id", $id)->countAllResults();
        // return view("users/update-profile", compact("users"));
        return view("users/apply-loker", compact("allloker", "totalLoker"));

    }

}