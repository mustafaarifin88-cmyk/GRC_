<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class NotifikasiAction extends Controller
{
    public function read($id)
    {
        $db = \Config\Database::connect();
        $db->table('tb_notifikasi')->where('id', $id)->update(['is_read' => 1]);
        return redirect()->back();
    }

    public function readAll()
    {
        $db = \Config\Database::connect();
        $db->table('tb_notifikasi')->where('user_id', session()->get('id'))->update(['is_read' => 1]);
        return redirect()->back();
    }
}