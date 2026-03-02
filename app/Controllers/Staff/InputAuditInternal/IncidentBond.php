<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntIncidentBondModel;

class IncidentBond extends BaseController
{
    protected $incidentModel;

    public function __construct()
    {
        $this->incidentModel = new IntIncidentBondModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Internal GRC - Incident Bond'
        ];
        return view('staff/internal_grc/incident_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'                => session()->get('id'),
            'judul'                  => $this->request->getPost('judul'),
            'tgl_waktu'              => $this->request->getPost('tgl_waktu'),
            'lokasi'                 => $this->request->getPost('lokasi'),
            'deskripsi'              => $this->request->getPost('deskripsi'),
            'jenis'                  => $this->request->getPost('jenis'),
            'dampak'                 => $this->request->getPost('dampak'),
            'pihak_terlibat'         => $this->request->getPost('pihak_terlibat'),
            'tindakan_darurat'       => $this->request->getPost('tindakan_darurat'),
            'rca_metode'             => $this->request->getPost('rca_metode'),
            'rca_faktor_penyebab'    => $this->request->getPost('rca_faktor_penyebab'),
            'rca_faktor_kontributor' => $this->request->getPost('rca_faktor_kontributor'),
            'tp_pendek'              => $this->request->getPost('tp_pendek'),
            'tp_panjang'             => $this->request->getPost('tp_panjang'),
            'tp_pj'                  => $this->request->getPost('tp_pj'),
            'pemulihan_langkah'      => $this->request->getPost('pemulihan_langkah'),
            'pemulihan_biaya'        => $this->request->getPost('pemulihan_biaya'),
            'pemulihan_waktu'        => $this->request->getPost('pemulihan_waktu'),
            'pemulihan_darurat'      => $this->request->getPost('pemulihan_darurat'),
            'status'                 => 'proses'
        ];

        $data['lampiran'] = $this->uploadFiles($this->request->getFileMultiple('lampiran'));

        $this->incidentModel->insert($data);
        session()->setFlashdata('success', 'Data Internal Incident Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/incident-bond'));
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