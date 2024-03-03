<?php

namespace App\Providers;

use DB;
use Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->verifyInstallation();
        Carbon::setUTF8(true);
        Carbon::setLocale(config('app.locale'));
        setlocale(LC_TIME, config('app.locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function verifyInstallation () {
        // If Application is not installed, attempt installer
        // Check connection
        try {
            $connection = DB::connection()->getPdo();

            if (!$connection || !Schema::hasTable('users')) {
                // Clear session just in case
                session()->flush();
                auth()->logout();
                Storage::disk('storage')->delete('installed');
                return redirect()->to('install');
            }
            return true;
        } catch (\Exception $e) {
            auth()->logout();
            session()->flush();
            Storage::disk('storage')->delete('installed');
            return redirect()->to('install');
        }
        return true;
    }
}
