<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Model;

class OrderLog extends Model
{
  protected $connection = 'mysql';

    protected $table= 'order_logs';
    protected $fillable = array(
    	
    );
    public $timestamps = false;
}
