<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
