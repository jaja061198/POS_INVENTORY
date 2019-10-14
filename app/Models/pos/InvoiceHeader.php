<?php

namespace App\Models\pos;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model
{
  protected $connection = 'mysql';

    protected $table= 'invoice_header';
    protected $fillable = array(

    );
    public $timestamps = false;
}
