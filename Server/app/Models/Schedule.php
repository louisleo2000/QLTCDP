<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'vaccine_id', 'date_time','status'
    ];
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class,'vaccine_id');
    }
    
}
