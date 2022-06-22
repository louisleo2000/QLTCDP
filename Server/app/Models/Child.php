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

 
    

    //return user hasManyThrough child
    public function user()
    {
        return $this->hasOneThrough(User::class,Parents::class,'id','id','parent_id','user_id');
    }
    //return parent
    public function parent()
    {
        return $this->belongsTo(Parents::class,'parent_id');
    }
    public function vaccinations()
    {
        return $this->hasMany(VaccinationDetails::class,'child_id');
    }
    //return vaccinations details
    
     public function vaccinationsDetails()
    {
        return ( VaccinationDetails::selectRaw(' vaccine_id, COUNT(vaccine_id) as number')->where('child_id', $this->id)->groupBy('vaccine_id')->with('vaccine')->get());
    }
    public function vaccine()
    {
        return $this->belongsToMany(Vaccine::class,'vaccination_details','child_id','vaccine_id');
    }
   
    public function vaccines()
    {
        return $this->hasManyThrough(Vaccine::class,VaccinationDetails::class,'child_id','id','id','vaccine_id');
    }

    
  
   









   
}
