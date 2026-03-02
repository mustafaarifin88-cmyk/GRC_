<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntFraudBondModel extends Model
{
    protected $table            = 'igrc_fraud_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'judul', 'tgl_pelaporan', 'pelapor', 'pihak_diduga', 'deskripsi',
        'bukti', 'nilai_kerugian', 'tindakan_korektif', 'tindakan_disiplin',
        'tuntutan_hukum', 'perbaikan_sistem', 'peningkatan_kontrol',
        'tindakan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}