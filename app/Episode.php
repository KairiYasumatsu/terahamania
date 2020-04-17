<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    public function path()
    {
        return route('episode.show', $this);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'members_episodes');
    }
}
