<?php

namespace App\Observers;

use App\Models\Flooring;
use Illuminate\Support\Facades\Session;

class FloringObserver
{
    /**
     * Handle the Flooring "created" event.
     */
    public function created(Flooring $flooring): void
    {
        //
    }

    /**
     * Handle the Flooring "updated" event.
     */
    public function updated(Flooring $flooring): void
    {
        //
    }

    /**
     * Handle the Flooring "deleted" event.
     */
    public function deleted(Flooring $flooring): void
    {
        //
    }

    /**
     * Handle the Flooring "restored" event.
     */
    public function restored(Flooring $flooring): void
    {
        //
    }

    /**
     * Handle the Flooring "force deleted" event.
     */
    public function forceDeleted(Flooring $flooring): void
    {
        //
    }

    public function retrieved(Flooring $model)
    {
        Session::put('flooring_id', $model->id);
    }
}
