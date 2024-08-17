<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garment extends Model 
{
    use HasFactory;

    protected $connection = 'mysql_esd';

    protected $fillable =['nik','name','department'];

    public function garmentDetails()
    {
        return $this->hasMany(GarmentDetail::class);
    }

    // Di dalam model Garment atau model terkait
    public function getJudgementCountsAttribute()
    {
        $okCount = GarmentDetail::where('garment_id', $this->id)
                    ->where(function($query) {
                        $query->where('judgement_d1', 'OK')
                            ->orWhere('judgement_d2', 'OK')
                            ->orWhere('judgement_d3', 'OK')
                            ->orWhere('judgement_d4', 'OK');
                    })
                    ->count();

        $ngCount = GarmentDetail::where('garment_id', $this->id)
                    ->where(function($query) {
                        $query->where('judgement_d1', 'NG')
                            ->orWhere('judgement_d2', 'NG')
                            ->orWhere('judgement_d3', 'NG')
                            ->orWhere('judgement_d4', 'NG');
                    })
                    ->count();

        return [
            'ok' => $okCount,
            'ng' => $ngCount,
        ];
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
