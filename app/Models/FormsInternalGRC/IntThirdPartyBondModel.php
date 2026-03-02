<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntThirdPartyBondModel extends Model
{
    protected $table            = 'igrc_third_party_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'nama_perusahaan', 'jenis_layanan', 'kontak', 'tgl_mulai', 'tgl_akhir',
        'risiko_jenis', 'risiko_tingkat', 'due_diligence',
        'klausul_keamanan', 'klausul_kepatuhan', 'klausul_audit',
        'pantau_kpi', 'pantau_laporan', 'pantau_audit', 'pantau_review',
        'tindakan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}