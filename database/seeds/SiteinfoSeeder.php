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
                'site_name' => 'SIER POS',
                'slogan' => 'Completo manejo de Stock.',
                'address' => 'Maturín Monagas',
                'phone' => '0412-1016309',
                'email' => 'rodriguezejl1@gmail.com',
                'owner_name' => 'Admin',
                'currency_code' => 'USD',
            ]
        );      

    }

}