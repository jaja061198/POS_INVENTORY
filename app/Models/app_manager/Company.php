<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $connection = 'mysql';

    protected $table= 'company';
    protected $fillable = array(

    );
    public $timestamps = false;
}
