<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table            = 'tb_company_profile';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_perusahaan', 'alamat', 'nama_pimpinan', 'logo'];
    protected $useTimestamps    = true;
    protected $createdField     = '';
    protected $updatedField     = 'updated_at';
}