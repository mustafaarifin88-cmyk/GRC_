<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntContinuityBondModel extends Model
{
    protected $table            = 'igrc_continuity_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'bia_proses', 'bia_dampak_keuangan', 'bia_dampak_operasional', 'bia_rto', 'bia_rpo',
        'drp_lokasi', 'drp_prosedur', 'drp_tim', 'drp_kontak',
        'bcp_strategi', 'bcp_prosedur', 'bcp_tim',
        'uji_tgl', 'uji_skenario', 'uji_hasil', 'uji_perbaikan',
        'tindakan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}