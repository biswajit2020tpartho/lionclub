<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views/admin', 'admin');
        $this->customValidation();
        Schema::defaultStringLength(191);
        if(Schema::hasTable('admin_settings')) {
            $settings = DB::table('admin_settings')->first();        
            if(!empty($settings)){
                config()->set('settings.appname', $settings->appname);
                config()->set('settings.logo', $settings->logo);            
                config()->set('settings.favicon', $settings->favicon);            
                config()->set('settings.site_phone_number', $settings->site_phone_number);
                config()->set('settings.site_address', $settings->site_address);            
                config()->set('settings.site_email', $settings->site_email);
                config()->set('settings.site_about', $settings->site_about);
                config()->set('settings.facebook_link', $settings->facebook_link);
                config()->set('settings.instagram_link', $settings->instagram_link);
                config()->set('settings.twitter_link', $settings->twitter_link);
                config()->set('settings.linkedin_link', $settings->linkedin_link);
                config()->set('settings.youtube_link', $settings->youtube_link);
            }
        }
    }

    private function customValidation() {
        Validator::extend('alpha_spaces', function ($attribute, $value) {
            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);
        },'The :attribute should be letters and spaces only');

        Validator::extend('alpha_num_spaces', function ($attribute, $value) {
            // This will only accept alphanumeric and spaces.
            return preg_match('/^[a-zA-Z0-9\s]+$/', $value);
        },'The :attribute should be alphanumeric characters and spaces only');
    }
}
