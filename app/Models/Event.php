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

    public function photo()
    {
        return $this->hasMany(Photo::class);
    }
}
