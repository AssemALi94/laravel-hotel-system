<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'accompanies',
        'room_number',
        'check_out',
        'service_id',
        'check_in',
        'reservation_price',
        'reserved_by'
    ];



    public function confirmed()
    {
        return $this->belongsTo(User::class,'confirmed_by','id');
    }



    public function reserved()
    {
        return $this->belongsTo(User::class,'reserved_by','id');
    }



    public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class,'room_number','number');
    }


}
