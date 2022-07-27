<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'location',
        'date',
        'description',
    ];

    public function photos()
    {
        return $this->belongsToMany(Photo::class);
    }
}
