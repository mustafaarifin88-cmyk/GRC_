<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MasterDataModel;
use App\Models\MasterLokasiModel;

class MasterData extends BaseController
{
    protected $areaModel;
    protected $lokasiModel;

    public function __construct()
    {
        $this->areaModel = new MasterDataModel();
        $this->lokasiModel = new MasterLokasiModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Kelola Master Data',
            'areas'   => $this->areaModel->findAll(),
            'lokasis' => $this->lokasiModel->findAll()
        ];
        return view('admin/master_data/index', $data);
    }

    public function store_area()
    {
        $this->areaModel->insert([
            'nama_area' => $this->request->getPost('nama_area')
        ]);
        session()->setFlashdata('success', 'Data Area berhasil ditambahkan');
        return redirect()->to(base_url('admin/master-data'));
    }

    public function delete_area($id)
    {
        $this->areaModel->delete($id);
        session()->setFlashdata('success', 'Data Area berhasil dihapus');
        return redirect()->to(base_url('admin/master-data'));
    }

    public function store_lokasi()
    {
        $this->lokasiModel->insert([
            'nama_lokasi' => $this->request->getPost('nama_lokasi')
        ]);
        session()->setFlashdata('success', 'Data Lokasi berhasil ditambahkan');
        return redirect()->to(base_url('admin/master-data'));
    }

    public function delete_lokasi($id)
    {
        $this->lokasiModel->delete($id);
        session()->setFlashdata('success', 'Data Lokasi berhasil dihapus');
        return redirect()->to(base_url('admin/master-data'));
    }
}