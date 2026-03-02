<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntComplianceBondModel extends Model
{
    protected $table            = 'igrc_compliance_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'nama_peraturan', 'no_peraturan', 'deskripsi', 'kategori',
        'kebijakan_nama', 'kebijakan_no', 'kebijakan_tgl_terbit', 'kebijakan_tgl_efektif', 'kebijakan_file',
        'id_area', 'periode_penilaian', 'status_kepatuhan', 'kepatuhan_bukti', 'kepatuhan_catatan',
        'celah_tindakan', 'celah_jadwal', 'celah_status',
        'bk_tgl', 'bk_deskripsi', 'bk_dokumen', 'bk_tindakan_darurat', 'bk_lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}