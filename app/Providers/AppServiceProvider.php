<?php

namespace App\Providers;

use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (in_array(config('app.env'), ['local', 'development'])) {
            DB::listen(function ($query) {
                $bindings = [];
                foreach ($query->bindings as $value) {
                    if ($value instanceof DateTime) {
                        array_push($bindings, $value->format('Y-m-d H:i:s'));
                    } else {
                        array_push($bindings, $value);
                    }
                }
                \Log::debug([
                    'query' => Str::replaceArray('?', $bindings, $query->sql),
                    'time' => $query->time.'ms',
                ]);
            });
        }
    }
}
