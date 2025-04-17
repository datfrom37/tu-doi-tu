<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Các đường dẫn chính của ứng dụng.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Đăng ký các route cho ứng dụng.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Đăng ký các route API.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        
    }

    /**
     * Đăng ký các route web.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php')); // Đường dẫn đến file web.php
    }
}
