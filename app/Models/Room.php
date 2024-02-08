<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['id','room_number','name','features','status','price','description','room_type','size','num_guests','periority'];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function Room_photos()
    {
        return $this->hasMany(Room_photo::class);
    }
    public function getRoomPhoto($id){
        $photos=Room_photo::where('room_id',$id);
        return $photos;
    }

}
