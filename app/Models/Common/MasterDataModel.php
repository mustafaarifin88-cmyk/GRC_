<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class MasterDataModel extends Model
{
    protected $table = 'master_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_area'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}