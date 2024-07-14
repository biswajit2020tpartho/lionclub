<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class GroupMember extends Model
{
    use HasFactory;
    protected $table='member_group';   

    public function getCategoryDetails(){
        return $this->belongsTo(Category::class, 'member_category_id','id');
    } 
}
