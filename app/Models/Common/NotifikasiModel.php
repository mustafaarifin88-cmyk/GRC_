<?php

namespace App\Models\Common;

use CodeIgniter\Model;

class NotifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'pesan', 'is_read'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
}