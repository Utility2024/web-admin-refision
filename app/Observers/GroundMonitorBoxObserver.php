<?php

namespace App\Observers;

use App\Models\GroundMonitorBox;
use Illuminate\Support\Facades\Session;

class GroundMonitorBoxObserver
{
    /**
     * Handle the GroundMonitorBox "created" event.
     */
    public function created(GroundMonitorBox $groundMonitorBox): void
    {
        //
    }

    /**
     * Handle the GroundMonitorBox "updated" event.
     */
    public function updated(GroundMonitorBox $groundMonitorBox): void
    {
        //
    }

    /**
     * Handle the GroundMonitorBox "deleted" event.
     */
    public function deleted(GroundMonitorBox $groundMonitorBox): void
    {
        //
    }

    /**
     * Handle the GroundMonitorBox "restored" event.
     */
    public function restored(GroundMonitorBox $groundMonitorBox): void
    {
        //
    }

    /**
     * Handle the GroundMonitorBox "force deleted" event.
     */
    public function forceDeleted(GroundMonitorBox $groundMonitorBox): void
    {
        //
    }

    public function retrieved(GroundMonitorBox $model)
    {
        Session::put('ground_monitor_box_id', $model->id);
    }
}
