<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
  protected $connection = 'mysql';

    protected $table= 'user_access';
    protected $fillable = array(

    );
    public $timestamps = false;
}
