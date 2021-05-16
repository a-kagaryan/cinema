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

    public $timestamps = false;

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function hall()
    {
        return $this->belongsTo(Hall::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
