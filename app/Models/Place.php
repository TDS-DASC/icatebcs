<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'telephone_number',
        'cover_path',
        'address_id',
        'center_id',
        'locality'
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

}
