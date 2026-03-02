<?php

namespace App\Models\FormsAudit;

use CodeIgniter\Model;

class InsidenModel extends Model
{
    protected $table            = 'da_formulir_insiden';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'judul', 'informasi_pelaporan', 'tanggal_waktu_kejadian', 'id_lokasi',
        'deskripsi_kejadian', 'jenis_insiden', 'dampak', 'pihak_terlibat', 'tindakan_darurat', 'lampiran_bukti',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}