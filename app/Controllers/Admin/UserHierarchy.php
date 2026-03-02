<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\HierarchyModel;

class UserHierarchy extends BaseController
{
    protected $userModel;
    protected $hierarchyModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->hierarchyModel = new HierarchyModel();
    }

    public function index()
    {
        $data = [
            'title'          => 'Setting Hirarki User',
            'pimpinanTinggi' => $this->userModel->where('level', 'PIMPINAN TINGGI')->findAll(),
            'managerial'     => $this->userModel->where('level', 'MANAGERIAL')->findAll(),
            'supervisor'     => $this->userModel->where('level', 'SUPERVISOR')->findAll(),
            'kepalaUnit'     => $this->userModel->where('level', 'KEPALA UNIT')->findAll()
        ];
        return view('admin/user_hierarchy/index', $data);
    }

    public function get_bawahan()
    {
        $atasanLevel = $this->request->getPost('atasan_level');
        $atasanId = $this->request->getPost('atasan_id');
        
        $bawahanLevel = '';
        switch ($atasanLevel) {
            case 'PIMPINAN TINGGI': $bawahanLevel = 'MANAGERIAL'; break;
            case 'MANAGERIAL': $bawahanLevel = 'SUPERVISOR'; break;
            case 'SUPERVISOR': $bawahanLevel = 'KEPALA UNIT'; break;
            case 'KEPALA UNIT': $bawahanLevel = 'STAFF'; break;
        }

        $assignedBawahanIds = array_column($this->hierarchyModel->findAll(), 'bawahan_id');
        $currentAtasanBawahanIds = array_column($this->hierarchyModel->where('atasan_id', $atasanId)->findAll(), 'bawahan_id');
        
        $allBawahan = $this->userModel->where('level', $bawahanLevel)->findAll();
        
        $availableBawahan = [];
        foreach ($allBawahan as $bawahan) {
            $isAssignedToOther = in_array($bawahan['id'], $assignedBawahanIds) && !in_array($bawahan['id'], $currentAtasanBawahanIds);
            if (!$isAssignedToOther) {
                $bawahan['is_checked'] = in_array($bawahan['id'], $currentAtasanBawahanIds);
                $availableBawahan[] = $bawahan;
            }
        }

        return $this->response->setJSON($availableBawahan);
    }

    public function save()
    {
        $atasanId = $this->request->getPost('atasan_id');
        $bawahanIds = $this->request->getPost('bawahan_ids') ?? [];

        $this->hierarchyModel->where('atasan_id', $atasanId)->delete();

        foreach ($bawahanIds as $bawahanId) {
            $this->hierarchyModel->insert([
                'atasan_id' => $atasanId,
                'bawahan_id' => $bawahanId
            ]);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Hirarki berhasil disimpan']);
    }
}