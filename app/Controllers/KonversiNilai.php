<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;

class KonversiNilai extends Controller
{
    public function index()
    {
        return view('konversi_nilai');
    }

    public function hitung()
    {
        $request = service('request');
        
        $validationRules = [
            'partisipasi' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'tugas' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'uts' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'uas' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]'
        ];

        $validationMessages = [
            'partisipasi' => [
                'required' => 'Nilai partisipasi tidak boleh kosong!',
                'numeric' => 'Nilai partisipasi harus berupa angka!',
                'greater_than_equal_to' => 'Nilai partisipasi harus di antara 0 - 100!',
                'less_than_equal_to' => 'Nilai partisipasi harus di antara 0 - 100!'
            ],
            'tugas' => [
                'required' => 'Nilai tugas tidak boleh kosong!',
                'numeric' => 'Nilai tugas harus berupa angka!',
                'greater_than_equal_to' => 'Nilai tugas harus di antara 0 - 100!',
                'less_than_equal_to' => 'Nilai tugas harus di antara 0 - 100!'
            ],
            'uts' => [
                'required' => 'Nilai UTS tidak boleh kosong!',
                'numeric' => 'Nilai UTS harus berupa angka!',
                'greater_than_equal_to' => 'Nilai UTS harus di antara 0 - 100!',
                'less_than_equal_to' => 'Nilai UTS harus di antara 0 - 100!'
            ],
            'uas' => [
                'required' => 'Nilai UAS tidak boleh kosong!',
                'numeric' => 'Nilai UAS harus berupa angka!',
                'greater_than_equal_to' => 'Nilai UAS harus di antara 0 - 100!',
                'less_than_equal_to' => 'Nilai UAS harus di antara 0 - 100!'
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $partisipasi = $request->getPost('partisipasi');
        $tugas = $request->getPost('tugas');
        $uts = $request->getPost('uts');
        $uas = $request->getPost('uas');

        // Hitung nilai akhir (NA)
        $na = ((2 * $partisipasi) + (3 * $tugas) + (2 * $uts) + (3 * $uas)) / 10;

        // Konversi nilai huruf (NH)
        if ($na >= 85) {
            $nh = 'A';
        } elseif ($na >= 80) {
            $nh = 'A-';
        } elseif ($na >= 75) {
            $nh = 'B+';
        } elseif ($na >= 70) {
            $nh = 'B';
        } elseif ($na >= 65) {
            $nh = 'B-';
        } elseif ($na >= 60) {
            $nh = 'C+';
        } elseif ($na >= 55) {
            $nh = 'C';
        } elseif ($na >= 40) {
            $nh = 'D';
        } else {
            $nh = 'E';
        }

        return redirect()->to(base_url('konversi-nilai/hasil'))->with('na', $na)->with('nh', $nh);
    }

    public function hasil()
{
    $na = session()->get('na');
    $nh = session()->get('nh');

    return view('hasil_konversi', ['na' => $na, 'nh' => $nh]);
}

}