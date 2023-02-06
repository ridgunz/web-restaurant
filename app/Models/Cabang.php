<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_cabang',
        'is_active'
    ];

    public $timestamps = true;

    public $table = "cabang";
}
