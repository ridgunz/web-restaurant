<?php

namespace App\Models;

use Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_order_cart extends Eloquent
{
    use HasFactory;

    protected $fillable = [
        'kasir_id',
        'pemesan',
        'tipe'
    ];
    public $table = "temp_order_cart";

    public function detail() {
        return $this->hasMany('App\Models\temp_order_detail_cart');
    }
    
}
