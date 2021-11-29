<?php

  

namespace App\Models;

  

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

  

class Discount extends Model
{

    use HasFactory;

	protected $primaryKey = 'discount_id';
    public $timestamps = false;

    protected $fillable = [

        'discount_type','discount_value'

    ];

}