<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_order_cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'kasir_id',
        'pemesan',
        'tipe'
    ];
    public $table = "temp_order_cart";
}
