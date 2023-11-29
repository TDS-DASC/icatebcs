<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        'locality',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->created_by = Auth::id();
        });
        self::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function create_author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function update_author()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
