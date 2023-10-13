<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instructor extends Model
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
        return $this->hasMany(Group::class);
    }
    public function courses(){
        return $this->belongsToMany(Course::class);
    }
    public function bank(){
        return $this->belongsTo(Bank::class);
    }
    public function training_fields(){
        return $this->belongsToMany(TrainingField::class);
    }
}
