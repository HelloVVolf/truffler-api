<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
