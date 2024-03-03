<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Setting;

class SiteinfoSeeder extends Seeder {


    public function run(){
            
        \Eloquent::unguard();


        \DB::table('settings')->truncate();

        $siteinfo = Setting::create(
            [
                'site_name' => 'MIO FRATELLO',
                'slogan' => 'SISTEMA CONTROL DE INVENTARIO',
                'address' => 'Maturín Monagas',
                'phone' => '0412-12345678',
                'email' => 'miofratello@gmail.com',
                'owner_name' => 'Admin',
                'currency_code' => 'USD',
            ]
        );      

    }

}