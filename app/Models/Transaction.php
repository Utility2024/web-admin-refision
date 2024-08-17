<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'material_id',
        'description_id',
        'type',
        'price',
        'transaction_type',
        'qty',
        'total_price',
        'pic',
        'keterangan',
        'created_by',  // Tambahkan ini
        'updated_by'   // Tambahkan ini
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'datetime',
        'price' => 'decimal:2',
        'qty' => 'integer',
        'total_price' => 'decimal:2',
    ];

    /**
     * Get the material that owns the transaction.
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Get the user who created the transaction.
     */
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
