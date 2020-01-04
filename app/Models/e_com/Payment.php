<?php

namespace App\Models\e_com;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $connection = 'mysql';

    protected $table= 'payment_guide';
    protected $fillable = array(

    );
    public $timestamps = false;
}
