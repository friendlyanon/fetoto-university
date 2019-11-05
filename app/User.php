<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function latestFiveImages()
    {
        return $this->images()->limit(5);
    }

    public function images()
    {
        return $this->hasMany(Image::class)->latest();
    }

    public function tierName()
    {
        return $this->tier()->select('name');
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
