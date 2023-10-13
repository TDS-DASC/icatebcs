<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingField extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'key',
        'name',
        'status',
        'type',
    ];
    public function groups(){
        return $this->hasMany(Group::class);
    }
    public function courses(){
        return $this->hasMany(Course::class);
    }
    public function instructors(){
        return $this->belongsToMany(Instructor::class);
    }
}
