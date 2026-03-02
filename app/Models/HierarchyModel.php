<?php

namespace App\Models;

use CodeIgniter\Model;

class HierarchyModel extends Model
{
    protected $table            = 'tb_user_hierarchy';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['atasan_id', 'bawahan_id'];
}