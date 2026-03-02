<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntRiskBondModel extends Model
{
    protected $table            = 'igrc_risk_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'judul', 'deskripsi', 'kategori', 'penyebab', 'dampak',
        'kemungkinan', 'tingkat', 'periode_penilaian', 'metode_penilaian', 'nilai_risiko',
        'mitigasi_tindakan', 'mitigasi_pj', 'mitigasi_jadwal', 'mitigasi_biaya',
        'pantau_kri', 'pantau_ambang', 'pantau_frekuensi', 'pantau_hasil', 'pantau_tindakan',
        'tindakan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}