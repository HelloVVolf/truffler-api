<?php

namespace App\Models;

use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB as FacadesDB;

class Rental extends Model
{
    use HasFactory;
    // protected $fillable = ['name', 'brand', 'seat', 'luggage', 'imagePath', 'slug', ""];
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($rental) {
            $rental->slug = $rental->generateSlug();
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

    public function price()
    {
        return $this->hasOne(Price::class)
            ->select('rental_id', FacadesDB::raw('MIN(amount) as amount'))
            ->where('amount', '>', 0) // Apply the condition before aggregation
            ->groupBy('rental_id');
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function orders()
    {
        return $this->morphMany(Order::class, 'type');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'type');
    }
}
