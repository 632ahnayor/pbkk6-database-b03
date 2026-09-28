<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request) {
        $requestedUser = $request->query('user');
        $user = match (is_string($requestedUser) ? strtolower($requestedUser) : null) {
            'andi' => 'Andi',
            'budi' => 'Budi',
            default => 'Guest',
        };
        $mode = $request->query('mode') === 'dark' ? 'dark' : 'light';

        return view('home', [
            'pageTitle' => 'PBKK Evolution',
            'user' => $user,
            'mode' => $mode,
        ]);
    }

    public function about() {
        return view('about', ['pageTitle' => 'About']);
    }
    
    public function project(Request $request) {
        $mode = $request->query('mode') === 'dark' ? 'dark' : 'light';

        return view('project', [
            'pageTitle' => 'Project',
            'mode' => $mode,
        ]);
    }
    
    public function kalkulator($angka1, $angka2, $operasi) {
        $hasil = '';
        $warning = '';

        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            $warning = 'angka1 dan angka2 harus berupa angka.';
        } else {
            $angka1 = (float) $angka1;
            $angka2 = (float) $angka2;

            if ($operasi=='tambah') {
                $hasil = $angka1 + $angka2;
            } elseif ($operasi=='kurang') {
                $hasil = $angka1 - $angka2;
            } elseif ($operasi=='kali') {
                $hasil = $angka1 * $angka2;
            } elseif ($operasi=='bagi') {
                if ($angka2 == 0) {
                    $warning = 'Pembagian dengan nol tidak diperbolehkan.';
                } else {
                    $hasil = $angka1 / $angka2;
                }
            } elseif ($operasi=='modulo') {
                if ($angka2 == 0) {
                    $warning = 'Modulo dengan nol tidak diperbolehkan.';
                } else {
                    $hasil = fmod($angka1, $angka2);
                }
            } elseif ($operasi=='pangkat') {
                $hasil = $angka1 ** $angka2;
            } else {
                $warning = 'Operasi tidak tersedia.';
            }
        }

        return view('kalkulator', [
            'pageTitle' => 'Kalkulator',
            'angka1' => $angka1,
            'angka2' => $angka2,
            'operasi' => $operasi,
            'hasil' => $hasil,
            'warning' => $warning,
        ]);
    }

    public function mahasiswa($nrp) {
        switch ($nrp) {
            case '5025241115':
                $nama = 'Royan Habibi Alfatih';
                $hobi = 'Membaca';
                $ipk = '3.62';
                break;
            
            default:
                $nama = 'Nama Mahasiswa';
                $nrp = '50XXXXXXXX';
                $hobi = 'Hobi Mahasiswa';
                $ipk = '4.00';
                break;
        }
        return view('mahasiswa', [
            'pageTitle' => 'Profil Mahasiswa',
            'nama' => $nama,
            'nrp' => $nrp,
            'hobi' => $hobi,
            'ipk' => $ipk,
        ]);
    }

    
    public function hitungipkForm() {
        return view('hitung-ipk', ['pageTitle' => 'Hitung IPK']);
    }

    public function hitungipk(Request $request) {
        $validated = $request->validate([
            'ip1' => ['required', 'numeric', 'between:0,4'],
            'ip2' => ['required', 'numeric', 'between:0,4'],
        ], [
            'ip1.required' => 'IP semester 1 wajib diisi.',
            'ip1.numeric' => 'IP semester 1 harus berupa angka.',
            'ip1.between' => 'IP semester 1 harus di antara 0.00 dan 4.00.',
            'ip2.required' => 'IP semester 2 wajib diisi.',
            'ip2.numeric' => 'IP semester 2 harus berupa angka.',
            'ip2.between' => 'IP semester 2 harus di antara 0.00 dan 4.00.',
        ]);

        return redirect()->route('hitung-ipk.result', [
            'ip1' => $validated['ip1'],
            'ip2' => $validated['ip2'],
        ]);
    }

    public function hitungipkResult($ip1, $ip2) {
        abort_unless(
            is_numeric($ip1) &&
            is_numeric($ip2) &&
            (float) $ip1 >= 0 &&
            (float) $ip1 <= 4 &&
            (float) $ip2 >= 0 &&
            (float) $ip2 <= 4,
            404
        );

        $ip1 = (float) $ip1;
        $ip2 = (float) $ip2;

        return view('hitung-ipk', [
            'pageTitle' => 'Hitung IPK',
            'ip1' => $ip1,
            'ip2' => $ip2,
            'hasil' => ($ip1 + $ip2) / 2,
        ]);
    }

    public function profilMahasiswa() {
        return redirect()->route('mahasiswa.show', ['nrp' => '5025241115']);
    }

    public function ideAgent() {
        return redirect()->route('agent', ['tema' => 'gmail']);
    }

    public function form() {
        return view('form', ['pageTitle' => 'Simple Secure Form']);
    }

    public function formPost(Request $request) {
        $request->validate([
            'nama' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'ends_with:@student.its.ac.id'],
            'kategori' => ['required', 'in:akademik,sarana,kegiatan'],
            'pesan' => ['required', 'string', 'min:15'],
        ]);

        return redirect()
            ->route('form.get')
            ->with('status', 'Masukan berhasil dikirim.');
    }
    

}
