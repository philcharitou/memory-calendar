<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'event_photo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'url',
        'format',
        'caption',
        'description',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
