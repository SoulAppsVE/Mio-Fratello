<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotationd extends Model
{
 	protected $fillable=['quotation_id','product_id','quantity','subtotal'];
}
