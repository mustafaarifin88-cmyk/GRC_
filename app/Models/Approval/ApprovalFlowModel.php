<?php

namespace App\Models\Approval;

use CodeIgniter\Model;

class ApprovalFlowModel extends Model
{
    protected $table = 'audit';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'status', 
        'ditolak_oleh', 
        'alasan_tolak'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getLaporanByBawahanIds(array $bawahanIds, array $statusIn = [])
    {
        $builder = $this->db->table($this->table)
            ->select('audit.*, users.nama_lengkap as nama_staff, master_data.nama_area')
            ->join('users', 'users.id = audit.staff_id')
            ->join('master_data', 'master_data.id = audit.area_id')
            ->whereIn('audit.staff_id', $bawahanIds)
            ->orderBy('audit.created_at', 'DESC');

        if (!empty($statusIn)) {
            $builder->whereIn('audit.status', $statusIn);
        }

        return $builder->get()->getResultArray();
    }
}