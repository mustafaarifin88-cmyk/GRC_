<?php

namespace App\Controllers\PimpinanTinggi;

use App\Controllers\BaseController;

class PantauProgres extends BaseController
{
    public function index()
    {
        $data = [
            'title'            => 'Pantau Progres & Riwayat Pengesahan',
            'da_audit'         => $this->getTrackedReports(\App\Models\FormsAudit\AuditBondModel::class),
            'da_compliance'    => $this->getTrackedReports(\App\Models\FormsAudit\ComplianceBondModel::class),
            'da_risk'          => $this->getTrackedReports(\App\Models\FormsAudit\RiskBondModel::class),
            'da_insiden'       => $this->getTrackedReports(\App\Models\FormsAudit\InsidenModel::class),
            'igrc_audit'       => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntAuditBondModel::class),
            'igrc_compliance'  => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntComplianceBondModel::class),
            'igrc_risk'        => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntRiskBondModel::class),
            'igrc_fraud'       => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntFraudBondModel::class),
            'igrc_incident'    => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntIncidentBondModel::class),
            'igrc_cyber'       => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntCyberBondModel::class),
            'igrc_third_party' => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntThirdPartyBondModel::class),
            'igrc_continuity'  => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntContinuityBondModel::class),
            'igrc_control'     => $this->getTrackedReports(\App\Models\FormsInternalGRC\IntControlBondModel::class),
        ];
        return view('pimpinan_tinggi/pantau_progres/index', $data);
    }

    private function getTrackedReports($modelClass)
    {
        $userId = session()->get('id');
        $model = new $modelClass();
        
        $downlineIds = $this->getAllSubordinates($userId);
        
        $statuses = ['approve_pt', 'ditolak'];

        $builder = $model->select($model->table . '.*, tb_users.nama_lengkap as nama_pembuat')
                         ->join('tb_users', 'tb_users.id = ' . $model->table . '.user_id', 'left');

        $builder->groupStart()
                ->where($model->table . '.user_id', $userId);
                
        if (!empty($downlineIds)) {
            $builder->orGroupStart()
                    ->whereIn($model->table . '.user_id', $downlineIds)
                    ->whereIn($model->table . '.status', $statuses)
                    ->groupEnd();
        }
        $builder->groupEnd();

        return $builder->orderBy($model->table . '.created_at', 'DESC')->findAll();
    }

    private function getAllSubordinates($userIds)
    {
        $db = \Config\Database::connect();
        $allBawahan = [];
        $currentAtasan = is_array($userIds) ? $userIds : [$userIds];
        
        while (!empty($currentAtasan)) {
            $res = $db->table('tb_user_hierarchy')->whereIn('atasan_id', $currentAtasan)->get()->getResultArray();
            $bawahanIds = array_column($res, 'bawahan_id');
            if (empty($bawahanIds)) break;
            $allBawahan = array_merge($allBawahan, $bawahanIds);
            $currentAtasan = $bawahanIds;
        }
        return array_unique($allBawahan);
    }

    public function detail_alasan($type, $id)
    {
        $model = clone $this->getModelByType($type);
        if ($model) {
            $laporan = $model->find($id);
            return $this->response->setJSON(['alasan_tolak' => $laporan['alasan_tolak'] ?? 'Tidak ada alasan terlampir.']);
        }
        return $this->response->setJSON(['alasan_tolak' => 'Data tidak ditemukan.']);
    }

    private function getModelByType($type)
    {
        switch ($type) {
            case 'da_audit': return new \App\Models\FormsAudit\AuditBondModel();
            case 'da_compliance': return new \App\Models\FormsAudit\ComplianceBondModel();
            case 'da_risk': return new \App\Models\FormsAudit\RiskBondModel();
            case 'da_insiden': return new \App\Models\FormsAudit\InsidenModel();
            case 'igrc_audit': return new \App\Models\FormsInternalGRC\IntAuditBondModel();
            case 'igrc_compliance': return new \App\Models\FormsInternalGRC\IntComplianceBondModel();
            case 'igrc_risk': return new \App\Models\FormsInternalGRC\IntRiskBondModel();
            case 'igrc_fraud': return new \App\Models\FormsInternalGRC\IntFraudBondModel();
            case 'igrc_incident': return new \App\Models\FormsInternalGRC\IntIncidentBondModel();
            case 'igrc_cyber': return new \App\Models\FormsInternalGRC\IntCyberBondModel();
            case 'igrc_third_party': return new \App\Models\FormsInternalGRC\IntThirdPartyBondModel();
            case 'igrc_continuity': return new \App\Models\FormsInternalGRC\IntContinuityBondModel();
            case 'igrc_control': return new \App\Models\FormsInternalGRC\IntControlBondModel();
            default: return null;
        }
    }
}