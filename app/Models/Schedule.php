<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'hall_id',
        'film_id',
        'date',
        'start_time',
        'end_time'
    ];

    public function film()
    {
        return $this->hasOne(Film::class);
    }

    public function hall()
    {
        return $this->hasOne(Hall::class);
    }
}
