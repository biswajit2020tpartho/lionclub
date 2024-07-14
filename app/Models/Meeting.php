<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    protected $table='cms_meeting';  
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'meeting_title'
            ]
        ];
    }  
}
