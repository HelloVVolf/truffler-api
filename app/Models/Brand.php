<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
