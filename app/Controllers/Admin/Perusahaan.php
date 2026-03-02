<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Common\PerusahaanModel;

class Perusahaan extends BaseController
{
    public function index()
    {
        $perusahaanModel = new PerusahaanModel();
        $perusahaan = $perusahaanModel->first();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'nama_perusahaan' => $this->request->getPost('nama_perusahaan'),
                'alamat'          => $this->request->getPost('alamat'),
                'nama_pimpinan'   => $this->request->getPost('nama_pimpinan'),
            ];

            $logo = $this->request->getFile('logo');
            if ($logo && $logo->isValid() && !$logo->hasMoved()) {
                if ($perusahaan && $perusahaan['logo'] != 'default_logo.png' && file_exists('uploads/perusahaan/' . $perusahaan['logo'])) {
                    unlink('uploads/perusahaan/' . $perusahaan['logo']);
                }
                $namaLogo = $logo->getRandomName();
                $logo->move('uploads/perusahaan', $namaLogo);
                $data['logo'] = $namaLogo;
            }

            if ($perusahaan) {
                $perusahaanModel->update($perusahaan['id'], $data);
            } else {
                $perusahaanModel->insert($data);
            }

            return redirect()->to('/admin/perusahaan')->with('success', 'Profil perusahaan berhasil disimpan');
        }

        return view('admin/perusahaan/index', [
            'title' => 'Setting Perusahaan',
            'perusahaan' => $perusahaan
        ]);
    }
}