<?php

if (!function_exists('get_sidebar_color')) {
    function get_sidebar_color($level) {
        switch ($level) {
            case 'ADMIN': return 'bg-gradient-to-r from-gray-700 to-gray-900';
            case 'STAFF': return 'bg-gradient-to-r from-blue-500 to-blue-700';
            case 'KEPALA UNIT': return 'bg-gradient-to-r from-teal-500 to-teal-700';
            case 'SUPERVISOR': return 'bg-gradient-to-r from-orange-500 to-orange-700';
            case 'MANAGERIAL': return 'bg-gradient-to-r from-purple-500 to-purple-700';
            case 'PIMPINAN TINGGI': return 'bg-gradient-to-r from-red-600 to-red-800';
            default: return 'bg-white';
        }
    }
}

if (!function_exists('format_tanggal')) {
    function format_tanggal($date) {
        return date('d M Y', strtotime($date));
    }
}

if (!function_exists('get_status_badge')) {
    function get_status_badge($status) {
        switch ($status) {
            case 'PROSES': return '<span class="badge bg-secondary">Proses</span>';
            case 'APPROVE_KU': return '<span class="badge bg-info">Disetujui Kepala Unit</span>';
            case 'APPROVE_SPV': return '<span class="badge bg-primary">Disetujui Supervisor</span>';
            case 'APPROVE_MGR': return '<span class="badge bg-warning">Disetujui Managerial</span>';
            case 'APPROVE_PT': return '<span class="badge bg-success">Disetujui Pimpinan Tinggi</span>';
            case 'DITOLAK': return '<span class="badge bg-danger">Ditolak</span>';
            default: return '<span class="badge bg-dark">-</span>';
        }
    }
}