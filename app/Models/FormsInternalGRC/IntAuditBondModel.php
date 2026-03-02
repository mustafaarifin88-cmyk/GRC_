<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntAuditBondModel extends Model
{
    protected $table            = 'igrc_audit_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'no_lisensi', 'organisasi', 'tgl_penugasan', 'jadwal_audit_tahunan', 'id_area',
        'periode_mulai', 'periode_selesai', 'tujuan_audit', 'hasil_audit_lapangan', 'tgl_pemeriksaan', 'id_lokasi',
        'item_1_ceklis', 'item_1_file', 'item_1_catatan',
        'item_2_ceklis', 'item_2_file', 'item_2_catatan',
        'item_3_ceklis', 'item_3_file', 'item_3_catatan',
        'temuan_deskripsi', 'temuan_kategori', 'temuan_dampak', 'temuan_bukti',
        'rtl_akar_masalah', 'rtl_tindakan', 'rtl_pj', 'rtl_jadwal', 'rtl_status',
        'rtl_tgl_pelaksanaan', 'rtl_deskripsi', 'rtl_dokumen', 'tindakan_darurat',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}