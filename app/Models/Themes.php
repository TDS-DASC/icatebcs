<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Themes extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'course_id'
    ];
    
    public function Course(){
        return $this->belongsTo(Course::class);
    }
}
