<?php

namespace Database\Seeders;

use App\Models\Kota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class KotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $response = Http::withHeaders([
            'key' => 'a6af13d8694b086e5148df4cb5693e79'
        ])->get('https://api.rajaongkir.com/starter/city');

        $kotas = $response['rajaongkir']['results'];

        foreach ($kotas as $kota) {
            $data_kota[] = [
                'id' => $kota['city_id'],
                'provinsi_id' => $kota['province_id'],
                'tipe' => $kota['type'],
                'nama_kota' => $kota['city_name'],
                'kode_pos' => $kota['postal_code'],
            ];
        }

        Kota::insert($data_kota);
    }
}
