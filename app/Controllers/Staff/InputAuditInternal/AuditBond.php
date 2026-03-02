<?php

namespace App\Controllers\Staff\InputAuditInternal;

use App\Controllers\BaseController;
use App\Models\FormsInternalGRC\IntAuditBondModel;
use App\Models\MasterDataModel;

class AuditBond extends BaseController
{
    protected $auditModel;
    protected $masterDataModel;

    public function __construct()
    {
        $this->auditModel = new IntAuditBondModel();
        $this->masterDataModel = new MasterDataModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('tb_master_lokasi');
        $lokasi = $builder->get()->getResultArray();

        $data = [
            'title'  => 'Internal GRC - Audit Bond',
            'areas'  => $this->masterDataModel->findAll(),
            'lokasi' => $lokasi
        ];
        return view('staff/internal_grc/audit_bond', $data);
    }

    public function store()
    {
        $data = [
            'user_id'              => session()->get('id'),
            'no_lisensi'           => $this->request->getPost('no_lisensi'),
            'organisasi'           => $this->request->getPost('organisasi'),
            'tgl_penugasan'        => $this->request->getPost('tgl_penugasan'),
            'jadwal_audit_tahunan' => $this->request->getPost('jadwal_audit_tahunan'),
            'id_area'              => $this->request->getPost('id_area'),
            'periode_mulai'        => $this->request->getPost('periode_mulai'),
            'periode_selesai'      => $this->request->getPost('periode_selesai'),
            'tujuan_audit'         => $this->request->getPost('tujuan_audit'),
            'hasil_audit_lapangan' => $this->request->getPost('hasil_audit_lapangan'),
            'tgl_pemeriksaan'      => $this->request->getPost('tgl_pemeriksaan'),
            'id_lokasi'            => $this->request->getPost('id_lokasi'),
            'item_1_ceklis'        => $this->request->getPost('item_1_ceklis'),
            'item_1_catatan'       => $this->request->getPost('item_1_catatan'),
            'item_2_ceklis'        => $this->request->getPost('item_2_ceklis'),
            'item_2_catatan'       => $this->request->getPost('item_2_catatan'),
            'item_3_ceklis'        => $this->request->getPost('item_3_ceklis'),
            'item_3_catatan'       => $this->request->getPost('item_3_catatan'),
            'temuan_deskripsi'     => $this->request->getPost('temuan_deskripsi'),
            'temuan_kategori'      => $this->request->getPost('temuan_kategori'),
            'temuan_dampak'        => $this->request->getPost('temuan_dampak'),
            'rtl_akar_masalah'     => $this->request->getPost('rtl_akar_masalah'),
            'rtl_tindakan'         => $this->request->getPost('rtl_tindakan'),
            'rtl_pj'               => $this->request->getPost('rtl_pj'),
            'rtl_jadwal'           => $this->request->getPost('rtl_jadwal'),
            'rtl_status'           => $this->request->getPost('rtl_status'),
            'rtl_tgl_pelaksanaan'  => $this->request->getPost('rtl_tgl_pelaksanaan'),
            'rtl_deskripsi'        => $this->request->getPost('rtl_deskripsi'),
            'tindakan_darurat'     => $this->request->getPost('tindakan_darurat'),
            'status'               => 'proses'
        ];

        $data['item_1_file']  = $this->uploadFiles($this->request->getFileMultiple('item_1_file'));
        $data['item_2_file']  = $this->uploadFiles($this->request->getFileMultiple('item_2_file'));
        $data['item_3_file']  = $this->uploadFiles($this->request->getFileMultiple('item_3_file'));
        $data['temuan_bukti'] = $this->uploadFiles($this->request->getFileMultiple('temuan_bukti'));
        $data['rtl_dokumen']  = $this->uploadFiles($this->request->getFileMultiple('rtl_dokumen'));

        $this->auditModel->insert($data);
        session()->setFlashdata('success', 'Data Internal Audit Bond berhasil dikirim.');
        return redirect()->to(base_url('staff/internal-grc/audit-bond'));
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