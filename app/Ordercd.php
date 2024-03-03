<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordercd extends Model
{
    protected $fillable=['orderc_id','product_id','quantity','subtotal'];
}
