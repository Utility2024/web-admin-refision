<?php

namespace App\Observers;

use App\Models\Garment;
use Illuminate\Support\Facades\Session;

class GarmentObserver
{
    /**
     * Handle the Garment "created" event.
     */
    public function created(Garment $garment): void
    {
        //
    }

    /**
     * Handle the Garment "updated" event.
     */
    public function updated(Garment $garment): void
    {
        //
    }

    /**
     * Handle the Garment "deleted" event.
     */
    public function deleted(Garment $garment): void
    {
        //
    }

    /**
     * Handle the Garment "restored" event.
     */
    public function restored(Garment $garment): void
    {
        //
    }

    /**
     * Handle the Garment "force deleted" event.
     */
    public function forceDeleted(Garment $garment): void
    {
        //
    }

    public function retrieved(Garment $model)
    {
        Session::put('garment_id', $model->id);
    }
}
