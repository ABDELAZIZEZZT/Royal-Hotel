<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = ['user_p_id','user_type','user_id','room_id','check_in','check_out','number_of_guests','price','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}
