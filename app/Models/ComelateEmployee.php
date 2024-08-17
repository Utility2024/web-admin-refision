<?php

namespace App\Models;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComelateEmployee extends Model
{
    use HasFactory;

    protected $connection = 'mysql_hr';

<<<<<<< HEAD
    protected $fillable = ['employee_id', 'name', 'department', 'alasan_terlambat', 'nama_security', 'tanggal', 'jam'];

    public function employees()
    {
        return $this->belongsTo(Employee::class);
    }
=======
    protected $fillable = ['nik', 'name', 'department', 'shift', 'alasan_terlambat', 'nama_security', 'tanggal', 'jam'];
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b

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
     * Get the employee related to this record.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'nik', 'user_login');
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
