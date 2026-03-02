<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HashGenerator extends Controller
{
    public function index()
    {
        // Password yang ingin di-hash
        $passwordPlain = '123456';
        
        // Membuat hash menggunakan algoritma BCRYPT bawaan PHP/CI4
        $passwordHash = password_hash($passwordPlain, PASSWORD_DEFAULT);

        // Menampilkan hasilnya
        echo "<h3>Generator Password Hash CodeIgniter 4</h3>";
        echo "Password Asli : <b>" . $passwordPlain . "</b><br>";
        echo "Password Hash : <br>";
        echo "<textarea rows='3' cols='70' readonly>" . $passwordHash . "</textarea><br><br>";
        echo "<i>* Silakan copy teks hash di dalam kotak di atas untuk keperluan Insert/Update di phpMyAdmin Anda.</i>";
    }
}