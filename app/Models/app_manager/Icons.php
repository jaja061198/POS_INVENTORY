<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class Icons extends Model
{
  	protected $connection = 'mysql';

    protected $table= 'fa_icons';
    protected $fillable = array(

    );
    public $timestamps = false;

    public static function getIconClass($ICON_CODE)
    {
    	$data = Icons::where('id','=',$ICON_CODE)->select('icon_class')->first();

    	return $data['icon_class'];
    }
}
