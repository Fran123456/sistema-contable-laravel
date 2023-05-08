<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notification';
    protected $fillable = [
        'body', 'title', 'type_id','user_id','created_at','updated_at'
    ];

    
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'noti_users','notification_id','user_id')
        ->withPivot('status','read');
    }

    public function owner(){
        return $this->belongsTo(user::class, 'user_id');
    }
    

    public function type(){
        return $this->belongsTo(NotiType::class, 'type_id');
    }
}
