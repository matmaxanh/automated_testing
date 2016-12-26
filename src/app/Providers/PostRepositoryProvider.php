<?php

namespace App\Providers;

use App\Entities\Repositories\Eloquent\PostRepository;
use App\Entities\Repositories\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PostRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
    }
}
