<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'vertical_lines',
        'horizontal_lines'
    ];

    public static $rules = [
        'name' => 'sometimes|required|max:255|unique:halls',
        'vertical_lines' => 'integer|min:1|max:100',
        'horizontal_lines' => 'integer|min:1|max:100',
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }

    public function createSeats(): void
    {
        for ($x = 1; $x <= $this->horizontal_lines; $x ++) {
            for ($y = 1; $y <= $this->vertical_lines; $y++) {
                Seat::create([
                    'hall_id' => $this->id,
                    'code' => "{$x} X {$y}",
                    'y' => $y,
                    'x' => $x
                ]);
            }
        }
    }
}
