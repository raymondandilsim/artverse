<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey = "a6af13d8694b086e5148df4cb5693e79";
    protected $apiBaseUrl = 'https://api.rajaongkir.com/starter';

    public function __construct()
    {
        $this->apiKey = "a6af13d8694b086e5148df4cb5693e79";
        $this->apiBaseUrl = 'https://api.rajaongkir.com/starter';
    }

    public function getProvinces()
    {
        // $response = Http::withHeaders([
        //     'key' => $this->apiKey,
        // ])->get($this->apiBaseUrl . '/province');

        // return $response['rajaongkir']['results'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: a6af13d8694b086e5148df4cb5693e79"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
            $data['provinsi'] = array('error'=>true);
        } else {
            // echo $response;
            $data['provinsi'] = json_decode($response);
        }
        return $data['provinsi'];
        // return $data;
    }

    public function getCitiesByProvince($provinceId)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey,
        ])->get($this->apiBaseUrl . '/city?province=' . $provinceId);

        return $response['rajaongkir']['results'];
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=39&province=".$provinceId,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //         "key: a6af13d8694b086e5148df4cb5693e79"
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     // echo "cURL Error #:" . $err;
        //     $data['kota'] = array('error' => true);
        // } else {
        //     // echo $response;
        //     $data['kota'] = json_decode($response);
        // }
        // return $data['kota'];
    }
}
