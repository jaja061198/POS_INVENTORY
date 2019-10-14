<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class WindowAccess extends Model
{
  protected $connection = 'mysql';

    protected $table= 'window_access';
    protected $fillable = array(

    );
    public $timestamps = false;
}
