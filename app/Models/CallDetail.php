<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallDetail extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'call_id',
        'duration',
        'call_time',
        'caller',
        'receiver',
        'status',
    ];

}
