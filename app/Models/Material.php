<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Material extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $connection = 'mysql_stock';

    protected $fillable = [
        'sap_code',
        'description',
        'type',
        'qty_first',
        'in',
        'out',
        'last_stock',
        'minimum_stock',
        'unit',
        'information',
        'price',
        'total_price'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'qty_first' => 'integer',
        'in' => 'integer',
        'out' => 'integer',
        'last_stock' => 'integer',
        'minimum_stock' => 'integer',
        'unit',
        'information',
        'price',
        'total_price'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
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
