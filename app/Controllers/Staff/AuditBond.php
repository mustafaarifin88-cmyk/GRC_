<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\Common\MasterDataModel;
use App\Models\Staff\AuditModel;
use App\Models\Staff\AuditFileModel;

class AuditBond extends BaseController
{
    public function index()
    {
        $masterDataModel = new MasterDataModel();
        
        $data = [
            'title' => 'Input Data Audit',
            'areas' => $masterDataModel->findAll()
        ];
        
        return view('staff/audit_bond/index', $data);
    }

    public function store()
    {
        $auditModel = new AuditModel();
        $auditFileModel = new AuditFileModel();

        $dataAudit = [
            'staff_id'            => $this->session->get('id'),
            'judul'               => $this->request->getPost('judul'),
            'area_id'             => $this->request->getPost('area_id'),
            'tanggal_audit'       => $this->request->getPost('tanggal_audit'),
            'catatan_kebijakan'   => $this->request->getPost('catatan_kebijakan'),
            'catatan_akses_fisik' => $this->request->getPost('catatan_akses_fisik'),
            'catatan_cctv'        => $this->request->getPost('catatan_cctv'),
            'temuan_deskripsi'    => $this->request->getPost('temuan_deskripsi'),
            'temuan_kategori'     => $this->request->getPost('temuan_kategori'),
            'temuan_dampak'       => $this->request->getPost('temuan_dampak'),
            'rekomendasi'         => $this->request->getPost('rekomendasi'),
            'status'              => 'PROSES'
        ];

        $auditModel->insert($dataAudit);
        $audit_id = $auditModel->getInsertID();

        $categories = [
            'bukti_kebijakan' => 'Kebijakan',
            'bukti_akses'     => 'Akses Fisik',
            'bukti_cctv'      => 'CCTV',
            'bukti_lainnya'   => 'Bukti Lainnya'
        ];

        foreach ($categories as $inputName => $kategori) {
            if ($files = $this->request->getFileMultiple($inputName)) {
                foreach ($files as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move('uploads/bukti_audit', $newName);
                        $auditFileModel->insert([
                            'audit_id'      => $audit_id,
                            'kategori_file' => $kategori,
                            'file_name'     => $newName
                        ]);
                    }
                }
            }
        }

        return redirect()->to('/staff/progres-laporan')->with('success', 'Data Audit berhasil disubmit');
    }
}