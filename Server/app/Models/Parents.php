<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'gender', 'citizen_id','img','tel', 'adress'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function childs()
    {
        return $this->hasMany(Child::class,'parent_id');
    }
}
