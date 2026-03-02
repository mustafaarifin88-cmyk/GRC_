<?php

namespace App\Controllers\KepalaUnit;

use App\Controllers\BaseController;
use App\Models\Approval\ApprovalFlowModel;
use App\Models\Common\HierarchyModel;
use App\Models\Common\NotifikasiModel;

class Approval extends BaseController
{
    protected $approvalFlowModel;
    protected $hierarchyModel;
    protected $notifikasiModel;

    public function __construct()
    {
        $this->approvalFlowModel = new ApprovalFlowModel();
        $this->hierarchyModel = new HierarchyModel();
        $this->notifikasiModel = new NotifikasiModel();
    }

    private function getBawahanIds()
    {
        $bawahan = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        return empty($bawahan) ? [0] : array_column($bawahan, 'bawahan_id');
    }

    public function index()
    {
        $bawahanIds = $this->getBawahanIds();
        
        $data = [
            'title'   => 'Approval Laporan Staff',
            'laporan' => $this->approvalFlowModel->getLaporanByBawahanIds($bawahanIds, ['PROSES', 'APPROVE_KU', 'DITOLAK'])
        ];

        return view('kepala_unit/approval/index', $data);
    }

    public function approve($id)
    {
        $this->approvalFlowModel->update($id, ['status' => 'APPROVE_KU', 'ditolak_oleh' => null, 'alasan_tolak' => null]);
        return redirect()->to('/kepala_unit/approval')->with('success', 'Laporan berhasil disetujui');
    }

    public function reject($id)
    {
        $alasan = $this->request->getPost('alasan_tolak');
        $audit = $this->approvalFlowModel->find($id);

        $this->approvalFlowModel->update($id, [
            'status'       => 'DITOLAK',
            'ditolak_oleh' => $this->session->get('id'),
            'alasan_tolak' => $alasan
        ]);

        $this->notifikasiModel->insert([
            'user_id' => $audit['staff_id'],
            'pesan'   => "Laporan '{$audit['judul']}' DITOLAK oleh Kepala Unit. Alasan: {$alasan}"
        ]);

        return redirect()->to('/kepala_unit/approval')->with('success', 'Laporan berhasil ditolak');
    }
}