<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourPrice extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // public function prices()
    // {
    //     return $this->hasMany(TourPrice::class);
    // }
}
