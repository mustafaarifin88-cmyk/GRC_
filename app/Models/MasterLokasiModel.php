<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterLokasiModel extends Model
{
    protected $table            = 'tb_master_lokasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_lokasi'];
}