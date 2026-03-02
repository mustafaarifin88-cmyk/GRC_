<?php

namespace App\Models\FormsAudit;

use CodeIgniter\Model;

class AuditBondModel extends Model
{
    protected $table            = 'da_audit_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'judul', 'informasi_audit', 'id_area', 'tanggal_audit',
        'item_1_ceklis', 'item_1_file', 'item_1_catatan',
        'item_2_ceklis', 'item_2_file', 'item_2_catatan',
        'item_3_ceklis', 'item_3_file', 'item_3_catatan',
        'temuan_deskripsi', 'temuan_kategori', 'temuan_dampak', 'temuan_rekomendasi', 'temuan_bukti',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}