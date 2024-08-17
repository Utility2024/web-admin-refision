<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class IonizerDetail extends Model 
{
    use HasFactory;

    protected $connection = 'mysql_esd';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ionizer_id',
        'area',
        'location',
        'pm_1',
        'pm_2',
        'pm_3',
        'c1',
        'judgement_c1',
        'c2',
        'judgement_c2',
        'c3',
        'judgement_c3',
        'remarks'
    ];

    /**
     * Get the ionizer that owns the ionizer detail.
     */
    public function ionizer()
    {
        return $this->belongsTo(Ionizer::class);
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
