<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
//use Spatie\Translatable\HasTranslations;


class CmsPages extends Model
{
	use Sluggable;
    //use HasTranslations;

    public $translatable = [];

	public function sluggable(): array
    {
        return [
            'page_slug' => [
                'source' => 'meta_title'
            ]
        ];
    }
    protected $table = 'cms_pages';
    public function getBanners(){
        return $this->hasMany('App\ManageBanner', 'page', 'id');
    }
    // active banners
    public function activeBanners() {
        return $this->getBanners()->where('status','=', 1);
    }
}
