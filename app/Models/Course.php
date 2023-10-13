<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'key',
        'name',
        'type_course',
        'description',
        'duration_course',
        'modality_course',
        'constancy_type',
        'training_field_id',
    ];
    public function instructors(){
        return $this->belongsToMany(Instructor::class);
    }
    public function training_field(){
        return $this->belongsTo(TrainingField::class);
    }
    public function groups(){
        return $this->hasMany(Group::class);
    }
    public function themes(){
        return $this->hasMany(Themes::class);
    }

}
