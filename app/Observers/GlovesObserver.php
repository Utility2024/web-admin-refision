<?php

namespace App\Observers;

use App\Models\Glove;
use Illuminate\Support\Facades\Session;

class GlovesObserver
{
    /**
     * Handle the Glove "created" event.
     */
    public function created(Glove $glove): void
    {
        //
    }

    /**
     * Handle the Glove "updated" event.
     */
    public function updated(Glove $glove): void
    {
        //
    }

    /**
     * Handle the Glove "deleted" event.
     */
    public function deleted(Glove $glove): void
    {
        //
    }

    /**
     * Handle the Glove "restored" event.
     */
    public function restored(Glove $glove): void
    {
        //
    }

    /**
     * Handle the Glove "force deleted" event.
     */
    public function forceDeleted(Glove $glove): void
    {
        //
    }

    public function retrieved(Glove $model)
    {
        Session::put('glove_id', $model->id);
    }
}
