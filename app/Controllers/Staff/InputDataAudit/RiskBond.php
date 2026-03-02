<?php

namespace App\Controllers\Staff\InputDataAudit;

use App\Controllers\BaseController;
use App\Models\FormsAudit\RiskBondModel;

class RiskBond extends BaseController
{
    protected $riskModel;

    public function __construct()
    {
        $this->riskModel = new RiskBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Input Data Audit - Risk Bond'
        ];
        return view('staff/data_audit/risk_bond', $data);
    }

    public function store()
    {
        $nilaiRisiko = $this->request->getPost('nilai_risiko');
        $tingkatRisiko = 'Rendah';
        if ($nilaiRisiko > 3 && $nilaiRisiko <= 7) {
            $tingkatRisiko = 'Sedang';
        } elseif ($nilaiRisiko > 7) {
            $tingkatRisiko = 'Tinggi';
        }

        $data = [
            'user_id'              => session()->get('id'),
            'judul'                => $this->request->getPost('judul'),
            'informasi_risiko'     => $this->request->getPost('informasi_risiko'),
            'deskripsi_risiko'     => $this->request->getPost('deskripsi_risiko'),
            'kategori_risiko'      => $this->request->getPost('kategori_risiko'),
            'tanggal_penilaian'    => $this->request->getPost('tanggal_penilaian'),
            'penyebab'             => $this->request->getPost('penyebab'),
            'dampak'               => $this->request->getPost('dampak'),
            'kemungkinan_terjadi'  => $this->request->getPost('kemungkinan_terjadi'),
            'metode_penilaian'     => $this->request->getPost('metode_penilaian'),
            'skala_penilaian'      => $this->request->getPost('skala_penilaian'),
            'nilai_risiko'         => $nilaiRisiko,
            'tingkat_risiko'       => $tingkatRisiko,
            'mitigasi_sudah'       => $this->request->getPost('mitigasi_sudah'),
            'mitigasi_rekomendasi' => $this->request->getPost('mitigasi_rekomendasi'),
            'status'               => 'proses'
        ];

        $data['mitigasi_bukti'] = $this->uploadFiles($this->request->getFileMultiple('mitigasi_bukti'));

        $this->riskModel->insert($data);
        session()->setFlashdata('success', 'Formulir Risk Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/input-data-audit/risk-bond'));
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