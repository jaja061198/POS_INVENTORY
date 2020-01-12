<?php

namespace App\Models\e_com;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
  protected $connection = 'mysql';

    protected $table= 'shipping_fee';
    protected $fillable = array(

    );
    public $timestamps = false;
}
