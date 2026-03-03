<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntFraudBondModel;

class FraudBond extends BaseController
{
    protected $fraudModel;

    public function __construct()
    {
        $this->fraudModel = new IntFraudBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Fraud Bond'
        ];
        return view('staff/internal_grc/fraud_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'             => session()->get('id'),
            'judul'               => $this->request->getPost('judul'),
            'tgl_pelaporan'       => $this->request->getPost('tgl_pelaporan'),
            'pelapor'             => $this->request->getPost('pelapor'),
            'pihak_diduga'        => $this->request->getPost('pihak_diduga'),
            'deskripsi'           => $this->request->getPost('deskripsi'),
            'nilai_kerugian'      => $this->request->getPost('nilai_kerugian'),
            'tindakan_korektif'   => $this->request->getPost('tindakan_korektif'),
            'tindakan_disiplin'   => $this->request->getPost('tindakan_disiplin'),
            'tuntutan_hukum'      => $this->request->getPost('tuntutan_hukum'),
            'perbaikan_sistem'    => $this->request->getPost('perbaikan_sistem'),
            'peningkatan_kontrol' => $this->request->getPost('peningkatan_kontrol'),
            'tindakan_darurat'    => $this->request->getPost('tindakan_darurat'),
            'status'              => 'proses'
        ];

        $data['bukti']    = $this->uploadFiles($this->request->getFileMultiple('bukti'));
        $data['lampiran'] = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->fraudModel->insert($data);

        helper('notif');
        kirim_notif_ke_atasan('Laporan Baru Masuk', 'Staff telah mengirimkan laporan Internal Fraud Bond baru yang menunggu verifikasi Anda.');

        session()->setFlashdata('success', 'Data Internal Fraud Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/fraud-bond'));
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