<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Child extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'gender',
        'weight',
        'height',
        'dob',
        'img',
        'health_nsurance_id'

    ];
    public function parent()
    {
        return $this->belongsTo(Parents::class,'parent_id');
    }
    public function vaccinations()
    {
        return $this->hasMany(VaccinationDetails::class,'child_id');
    }
     public function vaccinationsDetails()
    {
        return( VaccinationDetails::selectRaw(' vaccine_id, COUNT(vaccine_id) as number')->where('child_id', $this->id)->groupBy('vaccine_id')->with('vaccine')->get());
    }

}
