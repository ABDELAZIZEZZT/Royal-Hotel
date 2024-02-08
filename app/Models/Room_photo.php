<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room_photo extends Model
{
    use HasFactory;
    protected $fillable = ['room_id','p_photo','s_photo'];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
