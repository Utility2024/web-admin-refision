<?php

namespace App\Observers;

use App\Models\EquipmentGround;
use Illuminate\Support\Facades\Session;

class EquipmentGroundObserver
{
    /**
     * Handle the EquipmentGround "created" event.
     */
    public function created(EquipmentGround $equipmentGround): void
    {
        //
    }

    /**
     * Handle the EquipmentGround "updated" event.
     */
    public function updated(EquipmentGround $equipmentGround): void
    {
        //
    }

    /**
     * Handle the EquipmentGround "deleted" event.
     */
    public function deleted(EquipmentGround $equipmentGround): void
    {
        //
    }

    /**
     * Handle the EquipmentGround "restored" event.
     */
    public function restored(EquipmentGround $equipmentGround): void
    {
        //
    }

    /**
     * Handle the EquipmentGround "force deleted" event.
     */
    public function forceDeleted(EquipmentGround $equipmentGround): void
    {
        //
    }

    public function retrieved(EquipmentGround $model)
    {
        Session::put('equipment_ground_id', $model->id);
    }
}
