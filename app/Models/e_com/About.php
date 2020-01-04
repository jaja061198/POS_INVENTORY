<?php

namespace App\Models\e_com;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
  protected $connection = 'mysql';

    protected $table= 'about';
    protected $fillable = array(

    );
    public $timestamps = false;
}
