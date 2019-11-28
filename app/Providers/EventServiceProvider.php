<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\TaskAdjustDepthEvent;
use App\Events\TaskAdjustPointEvent;
use App\Listeners\UpdateDepthListener;
use App\Listeners\TaskCompletionListener;
use App\Listeners\UpdatePointListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        TaskAdjustDepthEvent::class => [
            UpdateDepthListener::class,
        ],

        TaskAdjustPointEvent::class => [
            UpdatePointListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
