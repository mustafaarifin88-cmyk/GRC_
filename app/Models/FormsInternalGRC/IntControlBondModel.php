<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntControlBondModel extends Model
{
    protected $table            = 'igrc_control_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'nama_kontrol', 'tujuan_kontrol', 'jenis_kontrol', 'id_area',
        'nilai_metode', 'nilai_frekuensi', 'nilai_hasil', 'nilai_bukti',
        'perbaikan_tindakan', 'perbaikan_pj', 'perbaikan_jadwal',
        'pantau_kci', 'pantau_ambang', 'pantau_frekuensi', 'pantau_hasil',
        'tindakan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}