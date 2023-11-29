<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'center_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function center()
    {
        return $this->belongsTo(Center::class);
    }

    public function created_students()
    {
        return $this->hasMany(Student::class, 'created_by');
    }

    public function updated_students()
    {
        return $this->hasMany(Student::class, 'updated_by');
    }

    public function created_instructors()
    {
        return $this->hasMany(Instructor::class, 'created_by');
    }

    public function updated_instructors()
    {
        return $this->hasMany(Instructor::class, 'updated_by');
    }

    public function created_places()
    {
        return $this->hasMany(Place::class, 'created_by');
    }

    public function updated_places()
    {
        return $this->hasMany(Place::class, 'updated_by');
    }
}
