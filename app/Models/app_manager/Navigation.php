<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    //
    protected $connection = 'mysql';

    protected $table= 'navigation';
    protected $fillable = array(

    );
    public $timestamps = false;

    public static function getNavigations($CLASS)
    {
    	return Navigation::where('WINDOW_CLASS','=',$CLASS)->where('WINDOW_TYPE','=','M')->orderBy('ORDER','ASC')->get();
    }

    public static function getCategory($WINDOW_ID)
    {
        return Navigation::where('PARENT','=',$WINDOW_ID)->orderBy('ORDER','ASC')->get();
    }

}
