<?php

namespace App\Models\FormsInternalGRC;

use CodeIgniter\Model;

class IntIncidentBondModel extends Model
{
    protected $table            = 'igrc_incident_bond';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 'judul', 'tgl_waktu', 'lokasi', 'deskripsi', 'jenis', 'dampak', 'pihak_terlibat', 'tindakan_darurat',
        'rca_metode', 'rca_faktor_penyebab', 'rca_faktor_kontributor',
        'tp_pendek', 'tp_panjang', 'tp_pj',
        'pemulihan_langkah', 'pemulihan_biaya', 'pemulihan_waktu', 'pemulihan_darurat', 'lampiran',
        'status', 'alasan_tolak', 'penolak_id'
    ];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}