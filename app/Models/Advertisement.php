<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Advertisement extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table='advertisement';
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'advertisement_title'
            ]
        ];
    }
}
