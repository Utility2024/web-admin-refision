<?php

namespace App\Observers;

use App\Models\Worksurface;
use Illuminate\Support\Facades\Session;

class WorksurfaceObserver
{
    /**
     * Handle the Worksurface "created" event.
     */
    public function created(Worksurface $worksurface): void
    {
        //
    }

    /**
     * Handle the Worksurface "updated" event.
     */
    public function updated(Worksurface $worksurface): void
    {
        //
    }

    /**
     * Handle the Worksurface "deleted" event.
     */
    public function deleted(Worksurface $worksurface): void
    {
        //
    }

    /**
     * Handle the Worksurface "restored" event.
     */
    public function restored(Worksurface $worksurface): void
    {
        //
    }

    /**
     * Handle the Worksurface "force deleted" event.
     */
    public function forceDeleted(Worksurface $worksurface): void
    {
        //
    }

    public function retrieved(Worksurface $model)
    {
        Session::put('worksurface_id', $model->id);
    }
}
