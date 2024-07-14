<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageBanner extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','description','image','status'
    ];

   protected $hidden = [
        'is_delete'
    ];

    public function getpage(){
        return $this->belongsTo('App\CmsPages', 'page', 'id');
    }
}
