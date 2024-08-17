<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorksurfaceDetail extends Model 
{
    use HasFactory;

    protected $connection = 'mysql_esd';

    // Tentukan atribut yang bisa diisi secara massal
    protected $fillable = [
        'worksurface_id',
        'area',
        'location',
        'item',
        'a1',
        'a1_scientific',
        'judgement_a1',
        'a2',
        'judgement_a2',
        'remarks',
    ];

    // Relasi many-to-one dengan Worksurface
    public function worksurface()
    {
        return $this->belongsTo(Worksurface::class);
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
