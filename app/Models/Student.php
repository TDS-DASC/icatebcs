<?php

namespace App\Models;

use App\Concerns\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        return $this->belongsToMany(Group::class)->withPivot('status');
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
