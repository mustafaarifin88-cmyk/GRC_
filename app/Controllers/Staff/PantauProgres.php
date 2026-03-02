<?php

namespace App\Controllers\Staff;

use App\Controllers\BaseController;
use App\Models\FormsAudit\AuditBondModel;
use App\Models\FormsAudit\ComplianceBondModel;
use App\Models\FormsAudit\RiskBondModel;
use App\Models\FormsAudit\InsidenModel;

class PantauProgres extends BaseController
{
    protected $auditModel;
    protected $complianceModel;
    protected $riskModel;
    protected $insidenModel;

    public function __construct()
    {
        $this->auditModel = new AuditBondModel();
        $this->complianceModel = new ComplianceBondModel();
        $this->riskModel = new RiskBondModel();
        $this->insidenModel = new InsidenModel();
    }

    public function index()
    {
        $userId = session()->get('id');
        $data = [
            'title'      => 'Pantau Progres Laporan',
            'audit'      => $this->auditModel->where('user_id', $userId)->findAll(),
            'compliance' => $this->complianceModel->where('user_id', $userId)->findAll(),
            'risk'       => $this->riskModel->where('user_id', $userId)->findAll(),
            'insiden'    => $this->insidenModel->where('user_id', $userId)->findAll(),
        ];
        return view('staff/pantau_progres/index', $data);
    }

    public function detail_alasan($type, $id)
    {
        $model = null;
        switch ($type) {
            case 'audit': $model = $this->auditModel; break;
            case 'compliance': $model = $this->complianceModel; break;
            case 'risk': $model = $this->riskModel; break;
            case 'insiden': $model = $this->insidenModel; break;
        }

        if ($model) {
            $laporan = $model->find($id);
            return $this->response->setJSON(['alasan_tolak' => $laporan['alasan_tolak'] ?? 'Tidak ada alasan.']);
        }
        return $this->response->setJSON(['alasan_tolak' => 'Data tidak ditemukan.']);
    }
}