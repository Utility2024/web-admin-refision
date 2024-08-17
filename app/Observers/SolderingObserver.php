<?php

namespace App\Observers;

use App\Models\Soldering;
use Illuminate\Support\Facades\Session;

class SolderingObserver
{
    /**
     * Handle the Soldering "created" event.
     */
    public function created(Soldering $soldering): void
    {
        //
    }

    /**
     * Handle the Soldering "updated" event.
     */
    public function updated(Soldering $soldering): void
    {
        //
    }

    /**
     * Handle the Soldering "deleted" event.
     */
    public function deleted(Soldering $soldering): void
    {
        //
    }

    /**
     * Handle the Soldering "restored" event.
     */
    public function restored(Soldering $soldering): void
    {
        //
    }

    /**
     * Handle the Soldering "force deleted" event.
     */
    public function forceDeleted(Soldering $soldering): void
    {
        //
    }

    public function retrieved(Soldering $model)
    {
        Session::put('soldering_id', $model->id);
    }
}
