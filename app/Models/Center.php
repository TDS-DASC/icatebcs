<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'short_name',
        'center_type',
        'cover_path',
        'address_id',
        'telephone_number',
        'director_name',
        'director_position',
    ];
    
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function places(){
        return $this->hasMany(Place::class);
    }
    public function instructors(){
        return $this->hasMany(Instructor::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
