<?php

namespace App\Models\app_manager;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
  protected $connection = 'mysql';

    protected $table= 'audit_trail_trn';
    protected $fillable = array(

    );
    public $timestamps = false;
}
