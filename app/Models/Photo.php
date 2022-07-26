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
    protected $table = 'event_photos';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'url',
        'format',
        'caption',
        'description',
    ];

    // Photo model belongs to an event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
