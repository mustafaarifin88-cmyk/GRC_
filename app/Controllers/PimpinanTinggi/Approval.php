<?php

namespace App\Controllers\PimpinanTinggi;

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

    private function getTargetStaffIds($filterMgrId = null, $filterSpvId = null, $filterKuId = null)
    {
        $mgrList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $mgrIds = empty($mgrList) ? [0] : array_column($mgrList, 'bawahan_id');

        if ($filterMgrId && in_array($filterMgrId, $mgrIds)) {
            $mgrIds = [$filterMgrId];
        }

        $spvList = $this->hierarchyModel->whereIn('atasan_id', $mgrIds)->findAll();
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
        $filterMgrId = $this->request->getGet('managerial_id');
        $filterSpvId = $this->request->getGet('supervisor_id');
        $filterKuId = $this->request->getGet('kepala_unit_id');
        
        $staffIds = $this->getTargetStaffIds($filterMgrId, $filterSpvId, $filterKuId);

        $mgrList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $mgrIds = empty($mgrList) ? [0] : array_column($mgrList, 'bawahan_id');

        $spvList = $this->hierarchyModel->whereIn('atasan_id', $mgrIds)->findAll();
        $spvIds = empty($spvList) ? [0] : array_column($spvList, 'bawahan_id');

        $kuList = $this->hierarchyModel->whereIn('atasan_id', $spvIds)->findAll();
        $kuIds = empty($kuList) ? [0] : array_column($kuList, 'bawahan_id');
        
        $data = [
            'title'       => 'Approval Laporan Staff',
            'laporan'     => $this->approvalFlowModel->getLaporanByBawahanIds($staffIds, ['APPROVE_MGR', 'APPROVE_PT', 'DITOLAK']),
            'managerials' => $this->userModel->whereIn('id', $mgrIds)->findAll(),
            'supervisors' => $this->userModel->whereIn('id', $spvIds)->findAll(),
            'kepala_unit' => $this->userModel->whereIn('id', $kuIds)->findAll(),
            'filter_mgr'  => $filterMgrId,
            'filter_spv'  => $filterSpvId,
            'filter_ku'   => $filterKuId
        ];

        return view('pimpinan_tinggi/approval/index', $data);
    }

    public function approve($id)
    {
        $this->approvalFlowModel->update($id, ['status' => 'APPROVE_PT', 'ditolak_oleh' => null, 'alasan_tolak' => null]);
        return redirect()->to('/pimpinan_tinggi/approval')->with('success', 'Laporan berhasil disetujui');
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
            'pesan'   => "Laporan '{$audit['judul']}' DITOLAK oleh Pimpinan Tinggi. Alasan: {$alasan}"
        ]);

        $kuHierarchy = $this->hierarchyModel->where('bawahan_id', $audit['staff_id'])->first();
        if ($kuHierarchy) {
            $this->notifikasiModel->insert([
                'user_id' => $kuHierarchy['atasan_id'],
                'pesan'   => "Laporan '{$audit['judul']}' dari staff DITOLAK oleh Pimpinan Tinggi. Alasan: {$alasan}"
            ]);

            $spvHierarchy = $this->hierarchyModel->where('bawahan_id', $kuHierarchy['atasan_id'])->first();
            if ($spvHierarchy) {
                $this->notifikasiModel->insert([
                    'user_id' => $spvHierarchy['atasan_id'],
                    'pesan'   => "Laporan '{$audit['judul']}' dari staff DITOLAK oleh Pimpinan Tinggi. Alasan: {$alasan}"
                ]);

                $mgrHierarchy = $this->hierarchyModel->where('bawahan_id', $spvHierarchy['atasan_id'])->first();
                if ($mgrHierarchy) {
                    $this->notifikasiModel->insert([
                        'user_id' => $mgrHierarchy['atasan_id'],
                        'pesan'   => "Laporan '{$audit['judul']}' dari staff DITOLAK oleh Pimpinan Tinggi. Alasan: {$alasan}"
                    ]);
                }
            }
        }

        return redirect()->to('/pimpinan_tinggi/approval')->with('success', 'Laporan berhasil ditolak');
    }
}