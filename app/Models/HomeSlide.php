<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    use HasFactory;
    //$fillable used for mass assignment or for use in associative array
    protected $fillable=[
        'title',
        'short_title',
        'home_slide',
        'video_url',
    ];
}
