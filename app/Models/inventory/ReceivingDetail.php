<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Model;

class ReceivingDetail extends Model
{
  protected $connection = 'mysql';

    protected $table= 'receiving_details';
    protected $fillable = array(
    	
    );
    public $timestamps = false;
}
