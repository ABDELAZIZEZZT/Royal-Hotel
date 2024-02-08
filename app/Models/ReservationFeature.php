<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationFeature extends Model
{
    use HasFactory;
    protected $table = 'reservations_features';

    protected $fillable = ['reservation_id','feature_id'];
    public function reservations()
    {
       return $this->belongsTo(Reservation::class);
    }
    public function features()
    {
        return $this->belongsTo(Feature::class );
    }

}
