<?php

namespace App\Models\inventory;

use Illuminate\Database\Eloquent\Model;

class ReceivingHeader extends Model
{
  protected $connection = 'mysql';

    protected $table= 'receiving_header';
    protected $fillable = array(
    	
    );
    public $timestamps = false;

    public function getDetails()
    {
    	return $this->hasMany('App\Models\inventory\ReceivingDetail','RR_CODE','RR_CODE');
    }
}
