<?php

namespace App\Controllers\Staff\InputDataAudit;

use App\Controllers\BaseController;
use App\Models\FormsAudit\AuditBondModel;
use App\Models\MasterDataModel;

class AuditBond extends BaseController
{
    protected $auditModel;
    protected $masterDataModel;

    public function __construct()
    {
        $this->auditModel = new AuditBondModel();
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Input Data Audit - Audit Bond',
            'areas' => $this->masterDataModel->findAll()
        ];
        return view('staff/data_audit/audit_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'            => session()->get('id'),
            'judul'              => $this->request->getPost('judul'),
            'informasi_audit'    => $this->request->getPost('informasi_audit'),
            'id_area'            => $this->request->getPost('id_area'),
            'tanggal_audit'      => $this->request->getPost('tanggal_audit'),
            'item_1_ceklis'      => $this->request->getPost('item_1_ceklis'),
            'item_1_catatan'     => $this->request->getPost('item_1_catatan'),
            'item_2_ceklis'      => $this->request->getPost('item_2_ceklis'),
            'item_2_catatan'     => $this->request->getPost('item_2_catatan'),
            'item_3_ceklis'      => $this->request->getPost('item_3_ceklis'),
            'item_3_catatan'     => $this->request->getPost('item_3_catatan'),
            'temuan_deskripsi'   => $this->request->getPost('temuan_deskripsi'),
            'temuan_kategori'    => $this->request->getPost('temuan_kategori'),
            'temuan_dampak'      => $this->request->getPost('temuan_dampak'),
            'temuan_rekomendasi' => $this->request->getPost('temuan_rekomendasi'),
            'status'             => 'proses'
        ];

        $data['item_1_file'] = $this->uploadFiles($this->request->getFileMultiple('item_1_file'));
        $data['item_2_file'] = $this->uploadFiles($this->request->getFileMultiple('item_2_file'));
        $data['item_3_file'] = $this->uploadFiles($this->request->getFileMultiple('item_3_file'));
        $data['temuan_bukti'] = $this->uploadFiles($this->request->getFileMultiple('temuan_bukti'));

        $this->auditModel->insert($data);

        helper('notif');
        kirim_notif_ke_atasan('Laporan Baru Masuk', 'Staff telah mengirimkan formulir laporan Audit Bond baru yang menunggu verifikasi Anda.');

        session()->setFlashdata('success', 'Formulir Audit Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/input-data-audit/audit-bond'));
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