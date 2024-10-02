<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->slug = $order->generateSlug();
        });
    }

    public function generateSlug()
    {
        $slug = mt_rand(1000000000000000, 9999999999999999); // Generate a random 16-digit number

        while (self::where('slug', $slug)->exists()) {
            $slug = mt_rand(1000000000000000, 9999999999999999);
        }

        return $slug;
    }

    public function type()
    {
        return $this->morphTo();
    }

    public function getImagePath()
    {
        if ($this->type instanceof \App\Models\Tour && $this->type->image) {
            return $this->type->image->path;
        } elseif ($this->type instanceof \App\Models\Rental && isset($this->type->imagePath)) {
            return $this->type->imagePath;
        }

        return null;
    }
}
