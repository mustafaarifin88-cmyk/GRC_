<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Common\UserModel;
use App\Models\Common\HierarchyModel;

class Hierarchy extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $hierarchyModel = new HierarchyModel();

        $data = [
            'title' => 'Setting Hierarchy',
            'pimpinan_tinggi' => $userModel->where('level', 'PIMPINAN TINGGI')->findAll(),
            'managerial'      => $userModel->where('level', 'MANAGERIAL')->findAll(),
            'supervisor'      => $userModel->where('level', 'SUPERVISOR')->findAll(),
            'kepala_unit'     => $userModel->where('level', 'KEPALA UNIT')->findAll(),
            'staff'           => $userModel->where('level', 'STAFF')->findAll(),
            'hierarchy'       => $hierarchyModel->findAll()
        ];

        return view('admin/hierarchy/index', $data);
    }

    public function save()
    {
        $hierarchyModel = new HierarchyModel();
        $atasan_id = $this->request->getPost('atasan_id');
        $bawahan_ids = $this->request->getPost('bawahan_ids');

        $hierarchyModel->where('atasan_id', $atasan_id)->delete();

        if (!empty($bawahan_ids)) {
            foreach ($bawahan_ids as $bawahan_id) {
                $hierarchyModel->insert([
                    'atasan_id'  => $atasan_id,
                    'bawahan_id' => $bawahan_id
                ]);
            }
        }

        return redirect()->to('/admin/hierarchy')->with('success', 'Hierarchy berhasil disimpan');
    }
}