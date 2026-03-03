<?php

if (!function_exists('kirim_notif_ke_atasan')) {
    function kirim_notif_ke_atasan($judul, $pesan) {
        $db = \Config\Database::connect();
        $userId = session()->get('id');
        
        // Cari siapa atasan dari user yang sedang login saat ini
        $hierarchy = $db->table('tb_user_hierarchy')->where('bawahan_id', $userId)->get()->getRowArray();
        
        if ($hierarchy) {
            $db->table('tb_notifikasi')->insert([
                'user_id'    => $hierarchy['atasan_id'],
                'judul'      => $judul,
                'pesan'      => $pesan,
                'is_read'    => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}