<?php

  

namespace App\Models;

  

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

  

class Product extends Model
{

    use HasFactory;

	protected $primaryKey = 'product_id';
    public $timestamps = false;

    protected $fillable = [

        'product_name','quantity','unit_price','tax_percentage','tax_amount','total'

    ];

}