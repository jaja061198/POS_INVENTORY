<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
  protected $connection = 'mysql';

    protected $table= 'invoice_detail';
    protected $fillable = array(

    );
    public $timestamps = false;
}
