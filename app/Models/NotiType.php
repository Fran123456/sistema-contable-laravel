<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotiType extends Model
{
    use HasFactory;
    protected $table = 'noti_types';
    protected $fillable = [
        'type','state'
    ];

   
}
