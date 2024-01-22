<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    public function index()
    {
        $tahun = '2021';
        return view('dashboard.index', compact('tahun'));
    }

    public function show(Request $request)
    {
        $tahun = $request->tahun;
        // Mengambil data menu dan transaksi dari API
        $menu = Http::get('http://tes-web.landa.id/intermediate/menu');
        $transaksi = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun='. $tahun);
        // Mengubah data menu dan transaksi menjadi array
        $datamenu = json_decode($menu);
        $datatransaksi = json_decode($transaksi);
        $value = 0;

        if ($request->tahun) {
            // Menghitung total penjualan dari semua transaksi dalam tahun yang diminta
            foreach ($datatransaksi as $hasil) {
                $value += $hasil->total;
            }

            // Inisialisasi array untuk menyimpan data penjualan setiap menu per bulan
            $title = $result = [];

            // Mengisi array $title dengan judul untuk setiap grafik
            foreach($datamenu as $dm){
                for ($i=1; $i <= 12 ; $i++) {
                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                    $bulan = strftime('%B', mktime(0, 0, 0, $i, 1));
                    $title[$dm->menu][$i] = "Detail Penjualan $dm->menu Pada Bulan $bulan";
                    $result[$dm->menu][$i] = 0;
                }
            }

            // Mengisi array $result dengan total penjualan setiap menu per bulan
            foreach($datatransaksi as $dt){
                $bulan = date('n', strtotime($dt->tanggal));
                $result[$dt->menu][$bulan] += $dt->total;
            }

            // Inisialisasi array untuk menyimpan total penjualan setiap bulan
            $sum = array_fill(1, 12, 0);

            foreach ($datatransaksi as $tb) {
                $bulans = date('n', strtotime($tb->tanggal));
                $sum[$bulans] += $tb->total;
            }

            // Inisialisasi array untuk menyimpan total penjualan setiap menu
            $summenu = array_fill_keys(array_column($datamenu, 'menu'), 0);

            // Mengisi array $summenu dengan total penjualan setiap menu
            foreach ($datatransaksi as $tr) {
                $summenu[$tr->menu] += $tr->total;
            }

            // Membuat array $data yang akan dikirim ke view
            $data = [
                'datamenu' => $datamenu,
                'datatransaksi' => $datatransaksi,
                'sum' => $sum,
                'rasult' => $result,
                'summenu' => $summenu,
            ];

            // Mengembalikan view dengan data yang disiapkan
            return view('dashboard.index', compact('tahun', 'data', 'datamenu', 'datatransaksi', 'result', 'value', 'sum', 'summenu', 'title'));
        } else {
            return redirect('/');
        }
    }
}
