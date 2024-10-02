<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewImage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($review_image) {
            $review_image->slug = $review_image->generateSlug();
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
}
