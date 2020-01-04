<?php

namespace App\Models\e_com;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
  protected $connection = 'mysql';

    protected $table= 'terms';
    protected $fillable = array(

    );
    public $timestamps = false;
}
