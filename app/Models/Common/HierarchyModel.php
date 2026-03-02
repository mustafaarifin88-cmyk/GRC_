<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class HierarchyModel extends Model
{
    protected $table = 'hierarchy';
    protected $primaryKey = 'id';
    protected $allowedFields = ['atasan_id', 'bawahan_id'];
    protected $useTimestamps = false;
}