<?php

namespace App\Providers;

use DB;
use Exception;
use Illuminate\Support\ServiceProvider;
use PDOException;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once app_path() . '/Helpers/Time.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(['app.locale' => 'id']);
        Carbon::setLocale('id');
        $agent = new \Jenssegers\Agent\Agent;
        $result = $agent->isMobile();
        if ($result) {
            abort(222);
        }
        
        try {
            DB::connection()
                ->getPdo();
        } catch (Exception $e) {
            abort($e instanceof PDOException ? 503 : 500);
        }
    }
}
