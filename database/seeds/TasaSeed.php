<?php

use Illuminate\Database\Seeder;
use App\Tasa;

class TasaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tasa = new Tasa;
      $tasa->tasa= 37.00;
      $tasa->save();
    }
}
