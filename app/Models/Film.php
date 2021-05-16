<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    public static $rules = [
        'title' => 'required|max:255',
        'description' => 'string',
        'duration' => 'required|integer|min:1|max:43200',
        'wallpaper' => 'string|max:255'
    ];

    protected $fillable = [
        'title',
        'description',
        'duration',
        'wallpaper'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }


}
