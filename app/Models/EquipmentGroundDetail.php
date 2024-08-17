<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EquipmentGroundDetail extends Model 
{
    use HasFactory;

    protected $connection = 'mysql_esd';

    protected $fillable = [
        'equipment_ground_id',
        'area',
        'location',
        'measure_results_ohm',
        'judgement_ohm',
        'measure_results_volts',
        'judgement_volts',
        'remarks',
    ];

    public function equipmentGround()
    {
        return $this->belongsTo(EquipmentGround::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated the transaction.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Boot method to attach model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Set the creator on creating event
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        // Set the updater on updating event
        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }

}
