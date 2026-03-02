<?php

namespace App\Controllers\Staff\InputDataAudit;

use App\Controllers\BaseController;
use App\Models\FormsAudit\InsidenModel;
use App\Models\MasterDataModel; 

class FormulirInsiden extends BaseController
{
    protected $insidenModel;
    protected $masterDataModel;

    public function __construct()
    {
        $this->insidenModel = new InsidenModel();
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_master_lokasi');
        $lokasi = $builder->get()->getResultArray();

        $data = [
            'title'  => 'Input Data Audit - Formulir Insiden',
            'lokasi' => $lokasi
        ];
        return view('staff/data_audit/formulir_insiden', $data);
    }

    public function store()
    {
        $data = [
            'user_id'                => session()->get('id'),
            'judul'                  => $this->request->getPost('judul'),
            'informasi_pelaporan'    => $this->request->getPost('informasi_pelaporan'),
            'tanggal_waktu_kejadian' => $this->request->getPost('tanggal_waktu_kejadian'),
            'id_lokasi'              => $this->request->getPost('id_lokasi'),
            'deskripsi_kejadian'     => $this->request->getPost('deskripsi_kejadian'),
            'jenis_insiden'          => $this->request->getPost('jenis_insiden'),
            'dampak'                 => $this->request->getPost('dampak'),
            'pihak_terlibat'         => $this->request->getPost('pihak_terlibat'),
            'tindakan_darurat'       => $this->request->getPost('tindakan_darurat'),
            'status'                 => 'proses'
        ];

        $data['lampiran_bukti'] = $this->uploadFiles($this->request->getFileMultiple('lampiran_bukti'));

        $this->insidenModel->insert($data);
        session()->setFlashdata('success', 'Formulir Pelaporan Insiden berhasil dikirim.');
        return redirect()->to(base_url('staff/input-data-audit/formulir-insiden'));
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