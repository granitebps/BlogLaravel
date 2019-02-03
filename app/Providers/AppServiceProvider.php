<?php

namespace App\Providers;

use App\Models\SettingModel;
use App\Models\TaskModel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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

        $data['setting'] = SettingModel::get_setting();
        $data['task'] = TaskModel::get_task();
        View::share($data);
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
}
