<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class GarmentDetail extends Model 
{
    use HasFactory;

    protected $connection = 'mysql_esd';

    protected $fillable = [
        'garment_id',
        'name',
        'd1',
        'd1_scientific',
        'judgement_d1',
        'd2',
        'd2_scientific',
        'judgement_d2',
        'd3',
        'd3_scientific',
        'judgement_d3',
        'd4',
        'd4_scientific',
        'judgement_d4',
        'remarks',
    ];

    public function garment()
    {
        return $this->belongsTo(Garment::class);
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
