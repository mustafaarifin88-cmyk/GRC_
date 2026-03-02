<?php

namespace App\Controllers\PimpinanTinggi;

use App\Controllers\BaseController;
use App\Models\Approval\ApprovalFlowModel;
use App\Models\Common\HierarchyModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CetakLaporan extends BaseController
{
    protected $approvalFlowModel;
    protected $hierarchyModel;

    public function __construct()
    {
        $this->approvalFlowModel = new ApprovalFlowModel();
        $this->hierarchyModel = new HierarchyModel();
    }

    public function index()
    {
        $mgrList = $this->hierarchyModel->where('atasan_id', $this->session->get('id'))->findAll();
        $mgrIds = empty($mgrList) ? [0] : array_column($mgrList, 'bawahan_id');

        $spvList = $this->hierarchyModel->whereIn('atasan_id', $mgrIds)->findAll();
        $spvIds = empty($spvList) ? [0] : array_column($spvList, 'bawahan_id');

        $kuList = $this->hierarchyModel->whereIn('atasan_id', $spvIds)->findAll();
        $kuIds = empty($kuList) ? [0] : array_column($kuList, 'bawahan_id');
        
        $staffList = $this->hierarchyModel->whereIn('atasan_id', $kuIds)->findAll();
        $staffIds = empty($staffList) ? [0] : array_column($staffList, 'bawahan_id');

        $laporan = $this->approvalFlowModel->getLaporanByBawahanIds($staffIds, ['APPROVE_MGR', 'APPROVE_PT']);
        
        $type = $this->request->getGet('type');

        if ($type === 'pdf') {
            $this->generatePdf($laporan);
        } elseif ($type === 'excel') {
            $this->generateExcel($laporan);
        }

        return redirect()->back()->with('error', 'Format cetak tidak valid');
    }

    private function generatePdf($laporan)
    {
        $dompdf = new Dompdf();
        $html = '<h2>Rekap Laporan Audit - Pimpinan Tinggi</h2><table border="1" cellpadding="5" cellspacing="0" width="100%">';
        $html .= '<tr><th>No</th><th>Judul</th><th>Staff</th><th>Area</th><th>Tanggal</th><th>Status</th></tr>';
        
        foreach ($laporan as $k => $row) {
            $html .= '<tr>';
            $html .= '<td>' . ($k + 1) . '</td>';
            $html .= '<td>' . $row['judul'] . '</td>';
            $html .= '<td>' . $row['nama_staff'] . '</td>';
            $html .= '<td>' . $row['nama_area'] . '</td>';
            $html .= '<td>' . $row['tanggal_audit'] . '</td>';
            $html .= '<td>' . $row['status'] . '</td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Rekap_Laporan_Audit_PT.pdf", array("Attachment" => false));
        exit;
    }

    private function generateExcel($laporan)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Judul Audit');
        $sheet->setCellValue('C1', 'Nama Staff');
        $sheet->setCellValue('D1', 'Area');
        $sheet->setCellValue('E1', 'Tanggal Audit');
        $sheet->setCellValue('F1', 'Status');

        $rowIdx = 2;
        foreach ($laporan as $k => $row) {
            $sheet->setCellValue('A' . $rowIdx, ($k + 1));
            $sheet->setCellValue('B' . $rowIdx, $row['judul']);
            $sheet->setCellValue('C' . $rowIdx, $row['nama_staff']);
            $sheet->setCellValue('D' . $rowIdx, $row['nama_area']);
            $sheet->setCellValue('E' . $rowIdx, $row['tanggal_audit']);
            $sheet->setCellValue('F' . $rowIdx, $row['status']);
            $rowIdx++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Rekap_Laporan_Audit_PT.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit;
    }
}