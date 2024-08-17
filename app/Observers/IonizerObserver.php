<?php

namespace App\Observers;

use App\Models\Ionizer;
use Illuminate\Support\Facades\Session;

class IonizerObserver
{
    /**
     * Handle the Ionizer "created" event.
     */
    public function created(Ionizer $ionizer): void
    {
        //
    }

    /**
     * Handle the Ionizer "updated" event.
     */
    public function updated(Ionizer $ionizer): void
    {
        //
    }

    /**
     * Handle the Ionizer "deleted" event.
     */
    public function deleted(Ionizer $ionizer): void
    {
        //
    }

    /**
     * Handle the Ionizer "restored" event.
     */
    public function restored(Ionizer $ionizer): void
    {
        //
    }

    /**
     * Handle the Ionizer "force deleted" event.
     */
    public function forceDeleted(Ionizer $ionizer): void
    {
        //
    }
    
    public function retrieved(Ionizer $model)
    {
        Session::put('ionizer_id', $model->id);
    }
}
