<?php

namespace App\Providers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(file_exists(storage_path('installed'))){
            if (Schema::hasTable('general_settings')) {
                $siteInfo = DB::table('general_settings')->first();
            }
            
            
            if (Schema::hasTable('social-setting')) {
                $social = DB::table('social-setting')->get();
            }
            
            if (Schema::hasTable('pages')) {
                $pages = DB::table('pages')->select(['page_title','page_slug'])->where('status','1')->get();
            }

            if (Schema::hasTable('categories')) {
                $latest_categories = DB::table('categories')->select(['categories.*',DB::raw('count(services.category) as count')])
                ->leftJoin('services','services.category','=','categories.cat_id')
                ->where('services.status','1')
                ->where('services.approved','1')
                ->where('services.approved','1')
                ->groupBy('categories.cat_id')
                ->orderBy('categories.cat_id','desc')->limit(5)->get();;
            }

            view()->share(['siteInfo'=> $siteInfo,'social_links'=>$social,'footer_pages'=>$pages,'latest_categories'=>$latest_categories]);
       } 
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
