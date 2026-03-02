<?php

namespace App\Models\Staff;

use CodeIgniter\Model;

class AuditFileModel extends Model
{
    protected $table = 'audit_files';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'audit_id', 
        'kategori_file', 
        'file_name'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = '';
}