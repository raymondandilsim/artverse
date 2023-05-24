<?php

namespace Database\Seeders;

use App\Models\Provinsi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProvinsiSeeder extends Seeder
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
        ])->get('https://api.rajaongkir.com/starter/province');

        $provinsis = $response['rajaongkir']['results'];

        foreach ($provinsis as $provinsi) {
            $data_provinsi[] = [
                'id' => $provinsi['province_id'],
                'provinsi' => $provinsi['province'],
            ];
        }

        Provinsi::insert($data_provinsi);
    }
}
