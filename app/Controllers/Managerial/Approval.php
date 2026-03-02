<?php

namespace App\Controllers\Managerial;

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

    private function getTargetStaffIds($filterSpvId = null, $filterKuId = null)
    {
        $spvList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $spvIds = empty($spvList) ? [0] : array_column($spvList, 'bawahan_id');

        if ($filterSpvId && in_array($filterSpvId, $spvIds)) {
            $spvIds = [$filterSpvId];
        }

        $kuList = $this->hierarchyModel->whereIn('atasan_id', $spvIds)->findAll();
        $kuIds = empty($kuList) ? [0] : array_column($kuList, 'bawahan_id');

        if ($filterKuId && in_array($filterKuId, $kuIds)) {
            $kuIds = [$filterKuId];
        }

        $staffList = $this->hierarchyModel->whereIn('atasan_id', $kuIds)->findAll();
        return empty($staffList) ? [0] : array_column($staffList, 'bawahan_id');
    }

    public function index()
    {
        $filterSpvId = $this->request->getGet('supervisor_id');
        $filterKuId = $this->request->getGet('kepala_unit_id');
        
        $staffIds = $this->getTargetStaffIds($filterSpvId, $filterKuId);

        $spvList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $spvIds = empty($spvList) ? [0] : array_column($spvList, 'bawahan_id');

        $kuList = $this->hierarchyModel->whereIn('atasan_id', $spvIds)->findAll();
        $kuIds = empty($kuList) ? [0] : array_column($kuList, 'bawahan_id');
        
        $data = [
            'title'       => 'Approval Laporan Staff',
            'laporan'     => $this->approvalFlowModel->getLaporanByBawahanIds($staffIds, ['APPROVE_SPV', 'APPROVE_MGR', 'DITOLAK']),
            'supervisors' => $this->userModel->whereIn('id', $spvIds)->findAll(),
            'kepala_unit' => $this->userModel->whereIn('id', $kuIds)->findAll(),
            'filter_spv'  => $filterSpvId,
            'filter_ku'   => $filterKuId
        ];

        return view('managerial/approval/index', $data);
    }

    public function approve($id)
    {
        $this->approvalFlowModel->update($id, ['status' => 'APPROVE_MGR', 'ditolak_oleh' => null, 'alasan_tolak' => null]);
        return redirect()->to('/managerial/approval')->with('success', 'Laporan berhasil disetujui');
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
            'pesan'   => "Laporan '{$audit['judul']}' DITOLAK oleh Managerial. Alasan: {$alasan}"
        ]);

        $kuHierarchy = $this->hierarchyModel->where('bawahan_id', $audit['staff_id'])->first();
        if ($kuHierarchy) {
            $this->notifikasiModel->insert([
                'user_id' => $kuHierarchy['atasan_id'],
                'pesan'   => "Laporan '{$audit['judul']}' dari staff DITOLAK oleh Managerial. Alasan: {$alasan}"
            ]);

            $spvHierarchy = $this->hierarchyModel->where('bawahan_id', $kuHierarchy['atasan_id'])->first();
            if ($spvHierarchy) {
                $this->notifikasiModel->insert([
                    'user_id' => $spvHierarchy['atasan_id'],
                    'pesan'   => "Laporan '{$audit['judul']}' dari staff DITOLAK oleh Managerial. Alasan: {$alasan}"
                ]);
            }
        }

        return redirect()->to('/managerial/approval')->with('success', 'Laporan berhasil ditolak');
    }
}