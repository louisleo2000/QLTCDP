<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalStaff extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'gender', 'citizen_id','img','tel'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function vaccinations()
    {
        return $this->hasMany(VaccinationDetails::class,'staff_id');
    }
}
