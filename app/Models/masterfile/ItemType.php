<?php

namespace App\Models\masterfile;

use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
  protected $connection = 'mysql';

    protected $table= 'item_type';
    protected $fillable = array(

    );
    public $timestamps = false;
}
