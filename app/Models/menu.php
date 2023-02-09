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
        'amount',
        'stock',
        'image',
        'kategori',
        'is_active',
        'menus'
    ];

    public $timestamps = true;

    public $table = "menu";
}
