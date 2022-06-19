<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'child_id', 'staff_id', 'vaccine_id','lot_number','number_injections'
    ];
    public function medicalStaff()
    {
        return $this->belongsTo(MedicalStaff::class,'staff_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'staff_id');
    }
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class,'vaccine_id');
    }
    public function child()
    {
        return $this->belongsTo(Child::class,'child_id');
    }
}
