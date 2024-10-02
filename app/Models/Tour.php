<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($tour) {
            $tour->slug = $tour->generateSlug();
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

    public function orders()
    {
        return $this->morphMany(Order::class, 'type');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'type');
    }

    public function tags()
    {
        return $this->belongsToMany(TourTag::class, 'tour_tag');
    }

    public function category()
    {
        return $this->belongsTo(TourCategory::class, 'tour_category_id');
    }

    public function image()
    {
        return $this->hasOne(TourImage::class)->oldest();
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function days()
    {
        return $this->hasMany(TourDay::class);
    }

    public function prices()
    {
        return $this->hasMany(TourPrice::class);
    }
}
