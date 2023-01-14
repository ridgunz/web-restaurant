<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama',
        'deskripsi',
        'harga',
        'stock',
        'image',
        'kategori',
        'is_active'
    ];

    public $timestamps = true;
}
