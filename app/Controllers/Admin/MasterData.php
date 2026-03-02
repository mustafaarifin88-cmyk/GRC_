<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Common\MasterDataModel;

class MasterData extends BaseController
{
    protected $masterDataModel;

    public function __construct()
    {
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Master Data Area',
            'areas' => $this->masterDataModel->findAll()
        ];
        return view('admin/master_data/index', $data);
    }

    public function save()
    {
        $id = $this->request->getPost('id');
        $data = ['nama_area' => $this->request->getPost('nama_area')];

        if ($id) {
            $this->masterDataModel->update($id, $data);
            $msg = 'Area berhasil diupdate';
        } else {
            $this->masterDataModel->insert($data);
            $msg = 'Area berhasil ditambahkan';
        }

        return redirect()->to('/admin/master-data')->with('success', $msg);
    }

    public function delete($id)
    {
        $this->masterDataModel->delete($id);
        return redirect()->to('/admin/master-data')->with('success', 'Area berhasil dihapus');
    }
}