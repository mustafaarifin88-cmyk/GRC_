<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CompanyModel;

class ProfilPerusahaan extends BaseController
{
    protected $companyModel;

    public function __construct()
    {
        $this->companyModel = new CompanyModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Setting Profil Perusahaan',
            'company' => $this->companyModel->first()
        ];
        return view('admin/profil_perusahaan/index', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $fileLogo = $this->request->getFile('logo');

        $data = [
            'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
            'alamat'          => $this->request->getPost('alamat'),
            'nama_pimpinan'   => $this->request->getPost('nama_pimpinan')
        ];

        if ($fileLogo->isValid() && !$fileLogo->hasMoved()) {
            $newName = $fileLogo->getRandomName();
            $fileLogo->move(FCPATH . 'uploads/company_logo', $newName);
            $data['logo'] = $newName;

            $oldData = $this->companyModel->find($id);
            if ($oldData['logo'] != 'default-logo.png' && file_exists(FCPATH . 'uploads/company_logo/' . $oldData['logo'])) {
                unlink(FCPATH . 'uploads/company_logo/' . $oldData['logo']);
            }
        }

        $this->companyModel->update($id, $data);
        session()->setFlashdata('success', 'Profil perusahaan berhasil diupdate');
        return redirect()->to(base_url('admin/profil-perusahaan'));
    }
}