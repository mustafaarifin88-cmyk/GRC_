<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntThirdPartyBondModel;

class ThirdPartyBond extends BaseController
{
    protected $thirdPartyModel;

    public function __construct()
    {
        $this->thirdPartyModel = new IntThirdPartyBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Third Party Bond'
        ];
        return view('staff/internal_grc/third_party_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'           => session()->get('id'),
            'nama_perusahaan'   => $this->request->getPost('nama_perusahaan'),
            'jenis_layanan'     => $this->request->getPost('jenis_layanan'),
            'kontak'            => $this->request->getPost('kontak'),
            'tgl_mulai'         => $this->request->getPost('tgl_mulai'),
            'tgl_akhir'         => $this->request->getPost('tgl_akhir'),
            'risiko_jenis'      => $this->request->getPost('risiko_jenis'),
            'risiko_tingkat'    => $this->request->getPost('risiko_tingkat'),
            'due_diligence'     => $this->request->getPost('due_diligence'),
            'klausul_keamanan'  => $this->request->getPost('klausul_keamanan'),
            'klausul_kepatuhan' => $this->request->getPost('klausul_kepatuhan'),
            'klausul_audit'     => $this->request->getPost('klausul_audit'),
            'pantau_kpi'        => $this->request->getPost('pantau_kpi'),
            'pantau_laporan'    => $this->request->getPost('pantau_laporan'),
            'pantau_audit'      => $this->request->getPost('pantau_audit'),
            'pantau_review'     => $this->request->getPost('pantau_review'),
            'tindakan_darurat'  => $this->request->getPost('tindakan_darurat'),
            'status'            => 'proses'
        ];

        $data['lampiran'] = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->thirdPartyModel->insert($data);

        helper('notif');
        kirim_notif_ke_atasan('Laporan Baru Masuk', 'Staff telah mengirimkan laporan Internal Third Party Bond baru yang menunggu verifikasi Anda.');

        session()->setFlashdata('success', 'Data Internal Third Party Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/third-party-bond'));
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