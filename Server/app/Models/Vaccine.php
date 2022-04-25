<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'age_type','age_distance', 'description'
    ];
    public function vaccinations()
    {
        return $this->hasMany(VaccinationDetails::class,'vaccine_id');
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class,'vaccine_id');
    }
}
