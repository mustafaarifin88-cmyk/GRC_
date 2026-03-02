<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntCyberBondModel;

class CyberBond extends BaseController
{
    protected $cyberModel;

    public function __construct()
    {
        $this->cyberModel = new IntCyberBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Cyber Bond'
        ];
        return view('staff/internal_grc/cyber_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'            => session()->get('id'),
            'aset'               => $this->request->getPost('aset'),
            'ancaman'            => $this->request->getPost('ancaman'),
            'kerentanan'         => $this->request->getPost('kerentanan'),
            'dampak'             => $this->request->getPost('dampak'),
            'tingkat'            => $this->request->getPost('tingkat'),
            'kontrol_jenis'      => $this->request->getPost('kontrol_jenis'),
            'kontrol_deskripsi'  => $this->request->getPost('kontrol_deskripsi'),
            'pantau_log'         => $this->request->getPost('pantau_log'),
            'pantau_deteksi'     => $this->request->getPost('pantau_deteksi'),
            'pantau_analisis'    => $this->request->getPost('pantau_analisis'),
            'pantau_uji'         => $this->request->getPost('pantau_uji'),
            'insiden_jenis'      => $this->request->getPost('insiden_jenis'),
            'insiden_target'     => $this->request->getPost('insiden_target'),
            'insiden_dampak'     => $this->request->getPost('insiden_dampak'),
            'insiden_penanganan' => $this->request->getPost('insiden_penanganan'),
            'tindakan_darurat'   => $this->request->getPost('tindakan_darurat'),
            'status'             => 'proses'
        ];

        $data['lampiran'] = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->cyberModel->insert($data);
        session()->setFlashdata('success', 'Data Internal Cyber Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/cyber-bond'));
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