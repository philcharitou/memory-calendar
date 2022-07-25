<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'url',
        'format',
        'caption',
        'description',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_photo_mapping');
    }
}
