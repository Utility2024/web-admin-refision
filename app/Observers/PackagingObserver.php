<?php

namespace App\Observers;

use App\Models\Packaging;
use Illuminate\Support\Facades\Session;

class PackagingObserver
{
    /**
     * Handle the Packaging "created" event.
     */
    public function created(Packaging $packaging): void
    {
        //
    }

    /**
     * Handle the Packaging "updated" event.
     */
    public function updated(Packaging $packaging): void
    {
        //
    }

    /**
     * Handle the Packaging "deleted" event.
     */
    public function deleted(Packaging $packaging): void
    {
        //
    }

    /**
     * Handle the Packaging "restored" event.
     */
    public function restored(Packaging $packaging): void
    {
        //
    }

    /**
     * Handle the Packaging "force deleted" event.
     */
    public function forceDeleted(Packaging $packaging): void
    {
        //
    }

    public function retrieved(Packaging $model)
    {
        Session::put('packaging_id', $model->id);
    }
}
