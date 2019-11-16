<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  protected $connection = 'mysql';

    protected $table= 'slider';
    protected $fillable = array(

    );
    public $timestamps = false;
}
