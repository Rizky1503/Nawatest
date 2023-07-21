<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiController extends Controller{
    public function orderAhas(){
        $path = 'backend/dist/assets/api/';

        $dataNameCust = file_get_contents(public_path($path.'apiCust.json'));
        $dataCust = json_decode($dataNameCust, true);

        $dataNameCabang = file_get_contents(public_path($path.'apiCabang.json'));
        $dataCabang = json_decode($dataNameCabang, true);        
        
        $final = [
            "status"=>1,
            "message"=>"Data Successfuly Retrieved."
        ];
        foreach ($dataCust['data'] as $key => $cust) {
            foreach ($dataCabang['data'] as $key1 => $cabang) {
                if($cabang['code'] == $cust['booking']['workshop']['code']){
                    $dataMaster = [
                        'name' => $cust['name'],
                        'email' => $cust['email'],
                        'booking_number' => $cust['booking']['booking_number'],
                        'book_date' => $cust['booking']['book_date'],
                        'ahass_code'=> $cabang['code'],
                        'ahass_name'=> $cabang['name'],
                        'ahass_address'=> $cabang['address'],
                        'ahass_contact'=> $cabang['phone_number'],
                        'ahass_distance'=> $cabang['distance'],
                        'motorcycle_ut_code'=> $cust['booking']['motorcycle']['ut_code'],
                        'motorcycle'=> $cust['booking']['motorcycle']['name']
                    ];
                    array_push($final, $dataMaster);
                }
            }
        }
        $array = collect($final)->sortBy('ahass_distance')->toArray();
        return json_encode($array);
    }
}
