<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function subdistricts()
    {
        return $this->hasManyThrough(Subdistrict::class, District::class);
    }

    public function places()
    {
        return $this->hasManyThrough(Place::class, Subdistrict::class, 'city_id', 'subdistrict_id', 'id', 'id');
    }
}
