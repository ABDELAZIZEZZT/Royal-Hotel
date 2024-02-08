<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physical_user extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','address','national_id','check_in','check_out','phone_number'];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

}
