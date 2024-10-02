<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDay extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function durations()
    {
        return $this->hasMany(TourDayDuration::class);
    }
}
