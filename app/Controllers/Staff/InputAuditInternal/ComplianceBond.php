<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntComplianceBondModel;
use App\Models\MasterDataModel;

class ComplianceBond extends BaseController
{
    protected $complianceModel;
    protected $masterDataModel;

    public function __construct()
    {
        $this->complianceModel = new IntComplianceBondModel();
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Compliance Bond',
            'areas' => $this->masterDataModel->findAll()
        ];
        return view('staff/internal_grc/compliance_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'               => session()->get('id'),
            'nama_peraturan'        => $this->request->getPost('nama_peraturan'),
            'no_peraturan'          => $this->request->getPost('no_peraturan'),
            'deskripsi'             => $this->request->getPost('deskripsi'),
            'kategori'              => $this->request->getPost('kategori'),
            'kebijakan_nama'        => $this->request->getPost('kebijakan_nama'),
            'kebijakan_no'          => $this->request->getPost('kebijakan_no'),
            'kebijakan_tgl_terbit'  => $this->request->getPost('kebijakan_tgl_terbit'),
            'kebijakan_tgl_efektif' => $this->request->getPost('kebijakan_tgl_efektif'),
            'id_area'               => $this->request->getPost('id_area'),
            'periode_penilaian'     => $this->request->getPost('periode_penilaian'),
            'status_kepatuhan'      => $this->request->getPost('status_kepatuhan'),
            'kepatuhan_catatan'     => $this->request->getPost('kepatuhan_catatan'),
            'celah_tindakan'        => $this->request->getPost('celah_tindakan'),
            'celah_jadwal'          => $this->request->getPost('celah_jadwal'),
            'celah_status'          => $this->request->getPost('celah_status'),
            'bk_tgl'                => $this->request->getPost('bk_tgl'),
            'bk_deskripsi'          => $this->request->getPost('bk_deskripsi'),
            'bk_tindakan_darurat'   => $this->request->getPost('bk_tindakan_darurat'),
            'status'                => 'proses'
        ];

        $data['kebijakan_file']  = $this->uploadFiles($this->request->getFileMultiple('kebijakan_file'), 'policy_files');
        $data['kepatuhan_bukti'] = $this->uploadFiles($this->request->getFileMultiple('kepatuhan_bukti'), 'audit_evidences');
        $data['bk_dokumen']      = $this->uploadFiles($this->request->getFileMultiple('bk_dokumen'), 'audit_evidences');
        $data['bk_lampiran']     = $this->uploadFiles($this->request->getFileMultiple('bk_lampiran'), 'audit_evidences');

        $this->complianceModel->insert($data);
        session()->setFlashdata('success', 'Data Internal Compliance Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/compliance-bond'));
    }

    private function uploadFiles($files, $folder)
    {
        $uploadedFiles = [];
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/' . $folder, $newName);
                    $uploadedFiles[] = $newName;
                }
            }
        }
        return json_encode($uploadedFiles);
    }
}