<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Place extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($place) {
            $place->slug = $place->generateSlug();
        });
    }

    public function generateSlug()
    {
        $randomString = Str::random(16);
        $slug = $randomString;


        while (self::where('slug', $slug)->exists()) {
            $newRandomString = Str::random(16);
            $slug = $newRandomString;
        }

        return $slug;
    }

    public function durations()
    {
        return $this->hasMany(TourDayDuration::class);
    }

    public function image()
    {
        return $this->hasOne(PlaceImage::class)->oldest();
    }

    public function images()
    {
        return $this->hasMany(PlaceImage::class);
    }

    public function category()
    {
        return $this->belongsTo(PlaceCategory::class, 'place_category_id');
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }
}
