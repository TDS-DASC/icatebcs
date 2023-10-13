<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        // 'name',
        'key',
        'course_id',
        'place_id',
        'instructor_id',
        'date_start',
        'date_end',
        'time_start',
        'time_end',
        'center_id'
        /*
        'price_instructor',
        'price_student',
        'min_students',
        'max_students',
        'status', */
    ];

    public function center(){
        return $this->belongsTo(Center::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }
    public function course(){
        return $this->belongsTo(Course::class);
    }
    public function students(){
        return $this->belongsToMany(Student::class)->withTimestamps()->withPivot('status');
    }
/*     public function trainingField(){
        return $this->belongsTo(TrainingField::class);
    } */
    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }
    // $g = Group::find(2)->days()->syncWithoutDetaching(Day::find(3))
    public function days(){
        return $this->morphToMany(Day::class, 'dayable')->orderBy('id');
    }
}

//Group::find(1)->students()->sync([21403 => ['status' => 'terminado']], false)