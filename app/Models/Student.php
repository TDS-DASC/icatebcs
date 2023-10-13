<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [
        'colonia',
        'codigo_postal',
        'numero',
        'city_id',
        'calle',
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }
    
    public function center(){
        return $this->belongsTo(Center::class);
    }
    public function groups(){
        return $this->belongsToMany(Group::class);
    }
}
