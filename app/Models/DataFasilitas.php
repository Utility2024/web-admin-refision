<?php

namespace App\Models;

use App\Models\User;
use App\Models\Area;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataFasilitas extends Model
{
    use HasFactory;

    protected $connection = 'mysql_ga';

    protected $fillable = ['area_id', 'category_id', 'register_no'];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id();
        });
    }
}
