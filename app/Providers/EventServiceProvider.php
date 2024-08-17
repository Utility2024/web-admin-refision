<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Models\EquipmentGround;
use App\Models\Flooring;
use App\Models\Garment;
use App\Models\Glove;
use App\Models\GroundMonitorBox;
use App\Models\Ionizer;
use App\Models\Packaging;
use App\Models\Soldering;
use App\Models\Worksurface;
use App\Observers\EquipmentGroundObserver;
use App\Observers\FloringObserver;
use App\Observers\GarmentObserver;
use App\Observers\GlovesObserver;
use App\Observers\GroundMonitorBoxObserver;
use App\Observers\IonizerObserver;
use App\Observers\PackagingObserver;
use App\Observers\SolderingObserver;
use App\Observers\WorksurfaceObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        EquipmentGround::observe(EquipmentGroundObserver::class);
        Flooring::observe(FloringObserver::class);
        Garment::observe(GarmentObserver::class);
        Glove::observe(GlovesObserver::class);
        GroundMonitorBox::observe(GroundMonitorBoxObserver::class);
        Ionizer::observe(IonizerObserver::class);
        Packaging::observe(PackagingObserver::class);
        Soldering::observe(SolderingObserver::class);
        Worksurface::observe(WorksurfaceObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
