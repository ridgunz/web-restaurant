<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class absen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'users_id',
        'flag_checkin',
        'flag_checkout',
        'checkout',
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    public $table = "absensi";


    /**
 * The attributes that should be cast.
 *
 * @var array
 */
protected $casts = [
    'created_at' => 'datetime:Y-m-d H:i:s',
    'updated_at' => 'datetime:Y-m-d H:i:s',
    'checkout' => 'datetime:Y-m-d H:i:s',
];
}
