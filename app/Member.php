<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'members_episodes');
    }
}
