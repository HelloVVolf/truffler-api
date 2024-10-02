<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $fillable = ['duration', 'amount', 'duration_id']; // Add other fillable fields

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }
}
