<?php

namespace App\Models\masterfile;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  protected $connection = 'mysql';

    protected $table= 'service';
    protected $fillable = array(

    );
    public $timestamps = false;
}
