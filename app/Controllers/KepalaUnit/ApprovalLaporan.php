<?php

namespace App\Controllers\KepalaUnit;

use App\Controllers\BaseController;
use App\Models\HierarchyModel;
use App\Models\NotificationModel;
use App\Models\UserModel;

class ApprovalLaporan extends BaseController
{
    protected $hierarchyModel;
    protected $notificationModel;
    protected $userModel;

    public function __construct()
    {
        $this->hierarchyModel = new HierarchyModel();
        $this->notificationModel = new NotificationModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $myId = session()->get('id');
        $bawahan = $this->hierarchyModel->where('atasan_id', $myId)->findAll();
        $bawahanIds = array_column($bawahan, 'bawahan_id');

        $laporanData = [];
        if (!empty($bawahanIds)) {
            $types = ['audit', 'compliance', 'risk', 'insiden', 'int_audit', 'int_compliance', 'int_risk', 'int_fraud', 'int_incident', 'int_cyber', 'int_third_party', 'int_continuity', 'int_control'];
            
            foreach ($types as $type) {
                $model = $this->getModelByType($type);
                $laporanData[$type] = $model->select($model->table . '.*, tb_users.nama_lengkap')
                                            ->join('tb_users', 'tb_users.id = ' . $model->table . '.user_id')
                                            ->whereIn('user_id', $bawahanIds)
                                            ->where($model->table . '.status', 'proses')
                                            ->findAll();
            }
        }

        $data = [
            'title'   => 'Approval Laporan Staff',
            'laporan' => $laporanData
        ];

        return view('kepala_unit/approval/index', $data);
    }

    public function detail($type, $id)
    {
        $model = $this->getModelByType($type);
        $data = [
            'title'   => 'Detail Laporan',
            'laporan' => $model->select($model->table . '.*, tb_users.nama_lengkap')
                               ->join('tb_users', 'tb_users.id = ' . $model->table . '.user_id')
                               ->where($model->table . '.id', $id)
                               ->first(),
            'type'    => $type
        ];
        return view('kepala_unit/approval/detail_laporan', $data);
    }

    public function approve($type, $id)
    {
        $model = $this->getModelByType($type);
        $model->update($id, ['status' => 'approve_ku']);
        
        helper('notif');
        kirim_notif_ke_atasan('Laporan Di-Approve Kepala Unit', 'Ada laporan staff yang telah disetujui Kepala Unit dan menunggu review Anda.');

        session()->setFlashdata('success', 'Laporan berhasil di-Approve.');
        return redirect()->to(base_url('kepalaunit/approval'));
    }

    public function reject()
    {
        $type = $this->request->getPost('type');
        $id = $this->request->getPost('id');
        $alasan = $this->request->getPost('alasan_tolak');
        $myId = session()->get('id');

        $model = $this->getModelByType($type);
        $laporan = $model->find($id);

        $model->update($id, [
            'status'       => 'ditolak',
            'alasan_tolak' => $alasan,
            'penolak_id'   => $myId
        ]);

        $this->notificationModel->insert([
            'user_id' => $laporan['user_id'],
            'judul'   => 'Laporan Ditolak Kepala Unit',
            'pesan'   => 'Laporan Anda (' . ($laporan['judul'] ?? 'Tanpa Judul') . ') ditolak. Alasan: ' . $alasan
        ]);

        session()->setFlashdata('success', 'Laporan berhasil di-Reject.');
        return redirect()->to(base_url('kepalaunit/approval'));
    }

    private function getModelByType($type)
    {
        switch ($type) {
            case 'audit': return new \App\Models\FormsAudit\AuditBondModel();
            case 'compliance': return new \App\Models\FormsAudit\ComplianceBondModel();
            case 'risk': return new \App\Models\FormsAudit\RiskBondModel();
            case 'insiden': return new \App\Models\FormsAudit\InsidenModel();
            case 'int_audit': return new \App\Models\FormsInternalGRC\IntAuditBondModel();
            case 'int_compliance': return new \App\Models\FormsInternalGRC\IntComplianceBondModel();
            case 'int_risk': return new \App\Models\FormsInternalGRC\IntRiskBondModel();
            case 'int_fraud': return new \App\Models\FormsInternalGRC\IntFraudBondModel();
            case 'int_incident': return new \App\Models\FormsInternalGRC\IntIncidentBondModel();
            case 'int_cyber': return new \App\Models\FormsInternalGRC\IntCyberBondModel();
            case 'int_third_party': return new \App\Models\FormsInternalGRC\IntThirdPartyBondModel();
            case 'int_continuity': return new \App\Models\FormsInternalGRC\IntContinuityBondModel();
            case 'int_control': return new \App\Models\FormsInternalGRC\IntControlBondModel();
            default: return null;
        }
    }
}