<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'colonia',
        'codigo_postal',
        'calle',
        'numero',
        'city_id',
        'municipio'
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function centers(){
        return $this->hasMany(Center::class);
    }
    public function place(){
        return $this->hasMany(Place::class);
    }
    public function instructor(){
        return $this->hasMany(Instructor::class);
    }
}
