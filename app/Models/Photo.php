<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'url',
        'caption',
        'description',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
