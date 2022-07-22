<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'date',
        'description',
    ];

    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'events_photos_mapping',
            'event_id', 'photo_id')
            ->as('event_photo');
    }
}
