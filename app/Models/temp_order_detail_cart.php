<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_order_detail_cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_makanan'
    ];
}
