<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'number';

    protected $fillable = [

        'floor_number',
        'created_by',
        'room_price',
        'capacity',
        'status',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class,'floor_number','number');
    }

    public function reservations(){
        return $this->hasMany(Reservation::class,'room_number','number');
    }
}
