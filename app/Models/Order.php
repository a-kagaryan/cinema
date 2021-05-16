<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'user_ip',
        'seat_id'
    ];

    public function shedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
