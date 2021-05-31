<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


    protected $fillable=([
        'name',
        'service_price',
        'created_by',
    ]);




    public function creator()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }



    public function reservations()
    {
        return $this->hasMany(Reservation::class,'service_id','id');
    }

}
