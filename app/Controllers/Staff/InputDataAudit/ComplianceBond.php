<?php

namespace App\Controllers\Staff\InputDataAudit;

use App\Controllers\BaseController;
use App\Models\FormsAudit\ComplianceBondModel;
use App\Models\MasterDataModel;

class ComplianceBond extends BaseController
{
    protected $complianceModel;
    protected $masterDataModel;

    public function __construct()
    {
        $this->complianceModel = new ComplianceBondModel();
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Input Data Audit - Compliance Bond',
            'areas' => $this->masterDataModel->findAll()
        ];
        return view('staff/data_audit/compliance_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'             => session()->get('id'),
            'judul'               => $this->request->getPost('judul'),
            'informasi_penilaian' => $this->request->getPost('informasi_penilaian'),
            'id_area'             => $this->request->getPost('id_area'),
            'periode_penilaian'   => $this->request->getPost('periode_penilaian'),
            'tanggal_penilaian'   => $this->request->getPost('tanggal_penilaian'),
            'item_1_ceklis'       => $this->request->getPost('item_1_ceklis'),
            'item_1_catatan'      => $this->request->getPost('item_1_catatan'),
            'item_2_ceklis'       => $this->request->getPost('item_2_ceklis'),
            'item_2_catatan'      => $this->request->getPost('item_2_catatan'),
            'item_3_ceklis'       => $this->request->getPost('item_3_ceklis'),
            'item_3_catatan'      => $this->request->getPost('item_3_catatan'),
            'celah_deskripsi'     => $this->request->getPost('celah_deskripsi'),
            'celah_dampak'        => $this->request->getPost('celah_dampak'),
            'celah_rekomendasi'   => $this->request->getPost('celah_rekomendasi'),
            'status'              => 'proses'
        ];

        $data['item_1_file'] = $this->uploadFiles($this->request->getFileMultiple('item_1_file'));
        $data['item_2_file'] = $this->uploadFiles($this->request->getFileMultiple('item_2_file'));
        $data['item_3_file'] = $this->uploadFiles($this->request->getFileMultiple('item_3_file'));

        $this->complianceModel->insert($data);
        session()->setFlashdata('success', 'Formulir Compliance Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/input-data-audit/compliance-bond'));
    }

    private function uploadFiles($files)
    {
        $uploadedFiles = [];
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/audit_evidences', $newName);
                    $uploadedFiles[] = $newName;
                }
            }
        }
        return json_encode($uploadedFiles);
    }
}