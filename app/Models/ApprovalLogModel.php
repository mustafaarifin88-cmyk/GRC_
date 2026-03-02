<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalLogModel extends Model
{
    protected $table            = 'tb_approval_log';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['laporan_id', 'tipe_laporan', 'user_id', 'status', 'catatan'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = '';
}