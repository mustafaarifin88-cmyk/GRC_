<?php

namespace App\Controllers\Managerial;

use App\Controllers\BaseController;
use App\Models\HierarchyModel;
use App\Models\NotificationModel;
use App\Models\UserModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;

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
        
        $spvData = $this->hierarchyModel->select('tb_users.id, tb_users.nama_lengkap')
                                        ->join('tb_users', 'tb_users.id = tb_user_hierarchy.bawahan_id')
                                        ->where('tb_user_hierarchy.atasan_id', $myId)
                                        ->findAll();

        $selectedSpv = $this->request->getGet('supervisor_id');
        $selectedKu = $this->request->getGet('kepala_unit_id');
        
        $kuList = [];
        $staffList = [];
        $laporanData = [];

        if ($selectedSpv) {
            $kuList = $this->hierarchyModel->select('tb_users.id, tb_users.nama_lengkap')
                                           ->join('tb_users', 'tb_users.id = tb_user_hierarchy.bawahan_id')
                                           ->where('tb_user_hierarchy.atasan_id', $selectedSpv)
                                           ->findAll();

            if ($selectedKu) {
                $staffData = $this->hierarchyModel->select('tb_users.id, tb_users.nama_lengkap')
                                                  ->join('tb_users', 'tb_users.id = tb_user_hierarchy.bawahan_id')
                                                  ->where('tb_user_hierarchy.atasan_id', $selectedKu)
                                                  ->findAll();
                $staffList = $staffData;
                $staffIds = array_column($staffData, 'id');

                if (!empty($staffIds)) {
                    $types = ['audit', 'compliance', 'risk', 'insiden', 'int_audit', 'int_compliance', 'int_risk', 'int_fraud', 'int_incident', 'int_cyber', 'int_third_party', 'int_continuity', 'int_control'];
                    
                    foreach ($types as $type) {
                        $model = $this->getModelByType($type);
                        $laporanData[$type] = $model->select($model->table . '.*, tb_users.nama_lengkap')
                                                    ->join('tb_users', 'tb_users.id = ' . $model->table . '.user_id')
                                                    ->whereIn('user_id', $staffIds)
                                                    ->where($model->table . '.status', 'approve_spv')
                                                    ->findAll();
                    }
                }
            }
        }

        $data = [
            'title'       => 'Approval Laporan dari Supervisor',
            'list_spv'    => $spvData,
            'selectedSpv' => $selectedSpv,
            'list_ku'     => $kuList,
            'selectedKu'  => $selectedKu,
            'list_staff'  => $staffList,
            'laporan'     => $laporanData
        ];

        return view('managerial/approval/index', $data);
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
        return view('managerial/approval/detail_laporan', $data);
    }

    public function approve($type, $id)
    {
        $model = $this->getModelByType($type);
        $model->update($id, ['status' => 'approve_mgr']);
        
        session()->setFlashdata('success', 'Laporan berhasil di-Approve.');
        return redirect()->back();
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
            'judul'   => 'Laporan Ditolak Managerial',
            'pesan'   => 'Laporan (' . ($laporan['judul'] ?? 'Tanpa Judul') . ') ditolak. Alasan: ' . $alasan
        ]);

        $atasanIds = $this->hierarchyModel->where('bawahan_id', $laporan['user_id'])->findAll();
        if(!empty($atasanIds)) {
            foreach($atasanIds as $atasan) {
                $this->notificationModel->insert([
                    'user_id' => $atasan['atasan_id'],
                    'judul'   => 'Laporan Staff Ditolak Managerial',
                    'pesan'   => 'Laporan staff ditolak oleh Managerial. Alasan: ' . $alasan
                ]);
            }
        }

        session()->setFlashdata('success', 'Laporan berhasil di-Reject.');
        return redirect()->back();
    }

    public function export_excel($type)
    {
        $model = $this->getModelByType($type);
        $data = $model->select($model->table . '.*, tb_users.nama_lengkap')
                      ->join('tb_users', 'tb_users.id = ' . $model->table . '.user_id')
                      ->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Staff');
        $sheet->setCellValue('C1', 'Judul Laporan');
        $sheet->setCellValue('D1', 'Status');
        
        $row = 2;
        $no = 1;
        foreach($data as $d) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $d['nama_lengkap']);
            $sheet->setCellValue('C' . $row, $d['judul'] ?? '-');
            $sheet->setCellValue('D' . $row, $d['status']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap_Laporan_' . $type . '_' . date('Ymd') . '.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }

    public function export_pdf($type, $id)
    {
        $model = $this->getModelByType($type);
        $laporan = $model->select($model->table . '.*, tb_users.nama_lengkap')
                         ->join('tb_users', 'tb_users.id = ' . $model->table . '.user_id')
                         ->where($model->table . '.id', $id)
                         ->first();

        $dompdf = new Dompdf();
        $html = '<h2>Detail Laporan - ' . strtoupper($type) . '</h2>';
        $html .= '<p><strong>Nama Staff:</strong> ' . $laporan['nama_lengkap'] . '</p>';
        $html .= '<p><strong>Judul:</strong> ' . ($laporan['judul'] ?? '-') . '</p>';
        $html .= '<p><strong>Status:</strong> ' . $laporan['status'] . '</p>';
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan_' . $type . '_' . $id . '.pdf', ['Attachment' => true]);
        exit;
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