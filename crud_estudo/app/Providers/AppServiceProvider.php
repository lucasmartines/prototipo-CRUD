<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Clients\ElevenLabsClient;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(ElevenLabsClient::class, function () {
                return new ElevenLabsClient(
                    config('services.eleven.api_key'),
                    config('services.eleven.voice_id')
                );
        });
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
