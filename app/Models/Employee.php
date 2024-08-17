<?php

namespace App\Models;

<<<<<<< HEAD
use App\Models\User;
use App\Models\ComelateEmployee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $connection = 'mysql_hr';

    protected $fillable = ['nik', 'name', 'dept'];

    public function comelateEmployees()
    {
        return $this->hasMany(ComelateEmployee::class);
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
=======
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    // Koneksi ke database mysql_employee
    protected $connection = 'mysql_employee';

    // Nama view yang akan digunakan
    protected $table = '_users'; // Ganti dengan nama view yang sesuai

    // Kolom yang akan diambil
    protected $fillable = [
        'ID',
        'Departement',
        'Display_Name',
        'user_login',
        'Last_Jobs',
        'Last_Route'
    ];

    // Primary key
    protected $primaryKey = 'ID';

    // Timestamps
    public $timestamps = false;

    // Definisi agar model ini bersifat read-only
    public function setAttribute($key, $value)
    {
        return null;
    }

    // Relationship with ComelateEmployee
    public function comelateEmployees()
    {
        return $this->hasMany(ComelateEmployee::class, 'nik', 'user_login');
>>>>>>> 5ebbe55bf3a1dce617b10df81e230d501914d10b
    }
}
