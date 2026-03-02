<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntContinuityBondModel;

class ContinuityBond extends BaseController
{
    protected $continuityModel;

    public function __construct()
    {
        $this->continuityModel = new IntContinuityBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Continuity Bond'
        ];
        return view('staff/internal_grc/continuity_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'                => session()->get('id'),
            'bia_proses'             => $this->request->getPost('bia_proses'),
            'bia_dampak_keuangan'    => $this->request->getPost('bia_dampak_keuangan'),
            'bia_dampak_operasional' => $this->request->getPost('bia_dampak_operasional'),
            'bia_rto'                => $this->request->getPost('bia_rto'),
            'bia_rpo'                => $this->request->getPost('bia_rpo'),
            'drp_lokasi'             => $this->request->getPost('drp_lokasi'),
            'drp_prosedur'           => $this->request->getPost('drp_prosedur'),
            'drp_tim'                => $this->request->getPost('drp_tim'),
            'drp_kontak'             => $this->request->getPost('drp_kontak'),
            'bcp_strategi'           => $this->request->getPost('bcp_strategi'),
            'bcp_prosedur'           => $this->request->getPost('bcp_prosedur'),
            'bcp_tim'                => $this->request->getPost('bcp_tim'),
            'uji_tgl'                => $this->request->getPost('uji_tgl'),
            'uji_skenario'           => $this->request->getPost('uji_skenario'),
            'uji_hasil'              => $this->request->getPost('uji_hasil'),
            'uji_perbaikan'          => $this->request->getPost('uji_perbaikan'),
            'tindakan_darurat'       => $this->request->getPost('tindakan_darurat'),
            'status'                 => 'proses'
        ];

        $data['lampiran'] = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->continuityModel->insert($data);
        session()->setFlashdata('success', 'Data Internal Continuity Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/continuity-bond'));
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