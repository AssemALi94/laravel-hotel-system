<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $primaryKey = 'number';

    protected $fillable=([
        'name',
        'no_of_rooms',
        'creator_id',

    ]);
    use HasFactory;

    public function rooms()
    {
        return $this->hasMany(Room::class,'floor_number','number');
    }


    public function creator()
    {
        return $this->belongsTo(User::class,'creator_id','id');
    }

}
