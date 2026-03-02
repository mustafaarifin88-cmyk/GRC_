<?php

namespace App\Models\Staff;

use CodeIgniter\Model;

class AuditModel extends Model
{
    protected $table = 'audit';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'staff_id', 
        'judul', 
        'area_id', 
        'tanggal_audit', 
        'catatan_kebijakan', 
        'catatan_akses_fisik', 
        'catatan_cctv', 
        'temuan_deskripsi', 
        'temuan_kategori', 
        'temuan_dampak', 
        'rekomendasi', 
        'status', 
        'ditolak_oleh', 
        'alasan_tolak'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}