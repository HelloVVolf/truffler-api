<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourDayDuration extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function day()
    {
        return $this->belongsTo(TourDay::class);
    }

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
