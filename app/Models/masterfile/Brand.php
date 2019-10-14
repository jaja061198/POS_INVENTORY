<?php

namespace App\Models\masterfile;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $connection = 'mysql';

    protected $table= 'brand';
    protected $fillable = array(

    );
    public $timestamps = false;
}
