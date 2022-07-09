<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','fire_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function parent()
    {
        return $this->hasOne(Parents::class);
    }
    public function info()
    {
        switch($this->role)
        {
            case 1:
                return $this->hasOne(MedicalStaff::class);
                break;
            case 3:
                return $this->hasOne(Parents::class);
                break;
            default:
                return $this->hasOne(MedicalStaff::class);
                break;
        }
       
    }
        
    public function medicalStaff()
    {
        return $this->hasOne(MedicalStaff::class);
    }
}
