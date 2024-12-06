<?php

namespace App\Providers;

use App\View\Composers\BackgroundImageComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Facades\View::composer('*', BackgroundImageComposer::class);
    }
}
