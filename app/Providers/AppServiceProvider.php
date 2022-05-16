<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Make Macro to set up api client request basic requirement instead of added in every request
        Http::macro('Ahmed', function () {
            return Http::withHeaders(['auth_token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTY1MjQ0MTg3NiwiZXhwIjoxNjUyNDQ1NDc2LCJuYmYiOjE2NTI0NDE4NzYsImp0aSI6InFqdUM5TDBiNHpCUFVaTWUiLCJzdWIiOjksInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.-oczxpPgTIuQ9ZsFPMLtyXhdHn28nKm8Lo30e4dD9N8'])
                ->baseUrl('http://127.0.0.1:8000/api/');
        });
    }
}
