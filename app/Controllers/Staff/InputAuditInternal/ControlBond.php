<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntControlBondModel;
use App\Models\MasterDataModel;

class ControlBond extends BaseController
{
    protected $controlModel;
    protected $masterDataModel;

    public function __construct()
    {
        $this->controlModel = new IntControlBondModel();
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Control Bond',
            'areas' => $this->masterDataModel->findAll()
        ];
        return view('staff/internal_grc/control_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'            => session()->get('id'),
            'nama_kontrol'       => $this->request->getPost('nama_kontrol'),
            'tujuan_kontrol'     => $this->request->getPost('tujuan_kontrol'),
            'jenis_kontrol'      => $this->request->getPost('jenis_kontrol'),
            'id_area'            => $this->request->getPost('id_area'),
            'nilai_metode'       => $this->request->getPost('nilai_metode'),
            'nilai_frekuensi'    => $this->request->getPost('nilai_frekuensi'),
            'nilai_hasil'        => $this->request->getPost('nilai_hasil'),
            'perbaikan_tindakan' => $this->request->getPost('perbaikan_tindakan'),
            'perbaikan_pj'       => $this->request->getPost('perbaikan_pj'),
            'perbaikan_jadwal'   => $this->request->getPost('perbaikan_jadwal'),
            'pantau_kci'         => $this->request->getPost('pantau_kci'),
            'pantau_ambang'      => $this->request->getPost('pantau_ambang'),
            'pantau_frekuensi'   => $this->request->getPost('pantau_frekuensi'),
            'pantau_hasil'       => $this->request->getPost('pantau_hasil'),
            'tindakan_darurat'   => $this->request->getPost('tindakan_darurat'),
            'status'             => 'proses'
        ];

        $data['nilai_bukti'] = $this->uploadFiles($this->request->getFileMultiple('nilai_bukti'));
        $data['lampiran']    = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->controlModel->insert($data);

        helper('notif');
        kirim_notif_ke_atasan('Laporan Baru Masuk', 'Staff telah mengirimkan laporan Internal Control Bond baru yang menunggu verifikasi Anda.');

        session()->setFlashdata('success', 'Data Internal Control Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/control-bond'));
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