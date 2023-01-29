<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'users_id',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    public $table = "absensi";
}
