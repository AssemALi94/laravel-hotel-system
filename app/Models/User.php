<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory,HasApiTokens, Notifiable,SoftDeletes,HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'national_id',
        'avatar',
        'phone',
        'role',
        'country'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function manager()
    {
        return $this->belongsTo(User::class,'manager_id','id');
    }
    public function approval()
    {
        return $this->belongsTo(User::class,'approval_id','id');
    }



    public function managers()
    {
        return $this->hasMany(User::class,'manager_id','id');
    }
    public function approvals()
    {
        return $this->hasMany(User::class,'approval_id','id');
    }



    //    Floors
    public function floors()
    {
        return $this->hasMany(Floor::class,'creator_id','id');
    }

    //    Rooms
    public function rooms()
    {
        return $this->hasMany(Room::class,'creator_id','id');
    }


    // Service
    public function services()
    {
        return $this->hasMany(Service::class,'created_by','id');
    }


    // Reservation


    public function confirmations()
    {
        return $this->hasMany(User::class,'confirmed_by','id');
    }

    public function reservations()
    {
        return $this->hasMany(User::class,'reserved_by','id');
    }
}
