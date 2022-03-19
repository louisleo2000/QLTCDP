<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'parent_id',
        'gender',
        'weight',
        'height',
        'birthday',
        'img'
    ];
    public function parent()
    {
        return $this->belongsTo(User::class,'parent_id');
    }

}
