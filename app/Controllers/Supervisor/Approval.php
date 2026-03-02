<?php

namespace App\Controllers\Supervisor;

use App\Controllers\BaseController;
use App\Models\Approval\ApprovalFlowModel;
use App\Models\Common\HierarchyModel;
use App\Models\Common\NotifikasiModel;
use App\Models\Common\UserModel;

class Approval extends BaseController
{
    protected $approvalFlowModel;
    protected $hierarchyModel;
    protected $notifikasiModel;
    protected $userModel;

    public function __construct()
    {
        $this->approvalFlowModel = new ApprovalFlowModel();
        $this->hierarchyModel = new HierarchyModel();
        $this->notifikasiModel = new NotifikasiModel();
        $this->userModel = new UserModel();
    }

    private function getTargetStaffIds($filterKuId = null)
    {
        $kuList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $kuIds = array_column($kuList, 'bawahan_id');

        if (empty($kuIds)) return [0];

        if ($filterKuId && in_array($filterKuId, $kuIds)) {
            $kuIds = [$filterKuId];
        }

        $staffList = $this->hierarchyModel->whereIn('atasan_id', $kuIds)->findAll();
        return empty($staffList) ? [0] : array_column($staffList, 'bawahan_id');
    }

    public function index()
    {
        $filterKuId = $this->request->getGet('kepala_unit_id');
        $staffIds = $this->getTargetStaffIds($filterKuId);

        $kuList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $kuIds = empty($kuList) ? [0] : array_column($kuList, 'bawahan_id');
        
        $data = [
            'title'       => 'Approval Laporan Staff',
            'laporan'     => $this->approvalFlowModel->getLaporanByBawahanIds($staffIds, ['APPROVE_KU', 'APPROVE_SPV', 'DITOLAK']),
            'kepala_unit' => $this->userModel->whereIn('id', $kuIds)->findAll(),
            'filter_ku'   => $filterKuId
        ];

        return view('supervisor/approval/index', $data);
    }

    public function approve($id)
    {
        $this->approvalFlowModel->update($id, ['status' => 'APPROVE_SPV', 'ditolak_oleh' => null, 'alasan_tolak' => null]);
        return redirect()->to('/supervisor/approval')->with('success', 'Laporan berhasil disetujui');
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
            'pesan'   => "Laporan '{$audit['judul']}' DITOLAK oleh Supervisor. Alasan: {$alasan}"
        ]);

        $staffHierarchy = $this->hierarchyModel->where('bawahan_id', $audit['staff_id'])->first();
        if ($staffHierarchy) {
            $this->notifikasiModel->insert([
                'user_id' => $staffHierarchy['atasan_id'],
                'pesan'   => "Laporan '{$audit['judul']}' dari staff diteruskan DITOLAK oleh Supervisor. Alasan: {$alasan}"
            ]);
        }

        return redirect()->to('/supervisor/approval')->with('success', 'Laporan berhasil ditolak');
    }
}