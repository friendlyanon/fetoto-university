<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    protected $casts = [
        'attributes' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
