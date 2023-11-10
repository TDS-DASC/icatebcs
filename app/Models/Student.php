<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Concerns\Filterable;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

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
