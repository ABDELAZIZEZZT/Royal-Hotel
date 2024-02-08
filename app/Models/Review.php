<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['id','user_id','user_p_id','room_id','comment','rating_on_room','rating_overall','user_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Physical_user()
    {
        return $this->belongsTo(Physical_user::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
