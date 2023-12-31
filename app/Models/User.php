<?php

namespace App\Models;

use App\Enums\TableEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
     protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    function scopeCekEmail($query, $email)
    {
        return $query->whereRaw('email = ?', $email)->first();
    }

    /**
     * @return BelongsTo
     */
    public function city():BelongsTo
    {
        return $this->belongsTo(CitySecond::class, "city_id", "city_id");
    }
}
