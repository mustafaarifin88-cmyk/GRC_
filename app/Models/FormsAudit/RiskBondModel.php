<?php

namespace App\Models\FormsAudit;

use CodeIgniter\Model;

class RiskBondModel extends Model
{
    protected $table            = 'da_risk_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'judul', 'informasi_risiko', 'deskripsi_risiko', 'kategori_risiko', 'tanggal_penilaian',
        'penyebab', 'dampak', 'kemungkinan_terjadi', 'metode_penilaian', 'skala_penilaian',
        'nilai_risiko', 'tingkat_risiko', 'mitigasi_sudah', 'mitigasi_rekomendasi', 'mitigasi_bukti',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}