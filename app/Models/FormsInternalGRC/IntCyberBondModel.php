<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntCyberBondModel extends Model
{
    protected $table            = 'igrc_cyber_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'aset', 'ancaman', 'kerentanan', 'dampak', 'tingkat',
        'kontrol_jenis', 'kontrol_deskripsi',
        'pantau_log', 'pantau_deteksi', 'pantau_analisis', 'pantau_uji',
        'insiden_jenis', 'insiden_target', 'insiden_dampak', 'insiden_penanganan',
        'tindakan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}