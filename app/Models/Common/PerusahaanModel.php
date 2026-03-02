<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class PerusahaanModel extends Model
{
    protected $table = 'perusahaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_perusahaan', 'alamat', 'nama_pimpinan', 'logo'];
    protected $useTimestamps = true;
    protected $createdField = '';
    protected $updatedField = 'updated_at';
}