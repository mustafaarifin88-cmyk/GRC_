<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntRiskBondModel;

class RiskBond extends BaseController
{
    protected $riskModel;

    public function __construct()
    {
        $this->riskModel = new IntRiskBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Risk Bond'
        ];
        return view('staff/internal_grc/risk_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'           => session()->get('id'),
            'judul'             => $this->request->getPost('judul'),
            'deskripsi'         => $this->request->getPost('deskripsi'),
            'kategori'          => $this->request->getPost('kategori'),
            'penyebab'          => $this->request->getPost('penyebab'),
            'dampak'            => $this->request->getPost('dampak'),
            'kemungkinan'       => $this->request->getPost('kemungkinan'),
            'tingkat'           => $this->request->getPost('tingkat'),
            'periode_penilaian' => $this->request->getPost('periode_penilaian'),
            'metode_penilaian'  => $this->request->getPost('metode_penilaian'),
            'nilai_risiko'      => $this->request->getPost('nilai_risiko'),
            'mitigasi_tindakan' => $this->request->getPost('mitigasi_tindakan'),
            'mitigasi_pj'       => $this->request->getPost('mitigasi_pj'),
            'mitigasi_jadwal'   => $this->request->getPost('mitigasi_jadwal'),
            'mitigasi_biaya'    => $this->request->getPost('mitigasi_biaya'),
            'pantau_kri'        => $this->request->getPost('pantau_kri'),
            'pantau_ambang'     => $this->request->getPost('pantau_ambang'),
            'pantau_frekuensi'  => $this->request->getPost('pantau_frekuensi'),
            'pantau_hasil'      => $this->request->getPost('pantau_hasil'),
            'pantau_tindakan'   => $this->request->getPost('pantau_tindakan'),
            'tindakan_darurat'  => $this->request->getPost('tindakan_darurat'),
            'status'            => 'proses'
        ];

        $data['lampiran'] = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->riskModel->insert($data);

        helper('notif');
        kirim_notif_ke_atasan('Laporan Baru Masuk', 'Staff telah mengirimkan laporan Internal Risk Bond baru yang menunggu verifikasi Anda.');

        session()->setFlashdata('success', 'Data Internal Risk Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/risk-bond'));
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