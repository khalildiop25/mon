<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('layouts.navbar', function ($view) {
            $user = Auth::user();

            if ($user) {
                $notifications = $user->unreadNotifications; // ou toutes si tu préfères
                $view->with('notifications', $notifications);
            } else {
                $view->with('notifications', collect());
            }
        });
    }

    public function register(): void
    {
        //
    }
}

