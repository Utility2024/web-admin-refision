<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Ticket extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang bisa diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_number',
        'title',
        'description',
        'status',
        'priority',
        'category_id',
        'assigned_to',
        'closed_at',
    ];

    /**
     * Relasi ke model `CategoryTicket`.
     */
    public function category()
    {
        return $this->belongsTo(CategoryTicket::class, 'category_id');
    }

    /**
     * Relasi ke model `User` sebagai pembuat tiket.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relasi ke model `User` sebagai pengguna yang ditugaskan.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Relasi ke model `User` yang terakhir mengupdate tiket.
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Boot method untuk menghubungkan event model.
     */
    protected static function boot()
    {
        parent::boot();

        // Set nomor tiket dan pembuat pada event creating
        static::creating(function ($model) {
            $model->ticket_number = self::generateTicketNumber(); // Generate nomor tiket
            $model->created_by = Auth::id(); // Set pembuat tiket
        });

        // Set pengupdate pada event updating
        static::updating(function ($model) {
            $model->updated_by = Auth::id();

            // Set closed_at jika status diubah menjadi "Closed"
            if ($model->isDirty('status') && $model->status === 'Closed') {
                $model->closed_at = Carbon::now('Asia/Jakarta'); // Set waktu ke Jakarta
            } elseif ($model->isDirty('status') && $model->status !== 'Closed') {
                $model->closed_at = null; // Reset closed_at jika status bukan "Closed"
            }
        });
    }

    /**
     * Generate nomor tiket otomatis.
     */
    public static function generateTicketNumber()
    {
        $today = Carbon::today()->format('d-m-Y'); // Format tanggal
        $latestTicket = self::whereDate('created_at', Carbon::today())->latest('id')->first(); // Dapatkan tiket terbaru hari ini

        // Jika ada tiket sebelumnya, tambahkan 1 pada nomor tiket
        if ($latestTicket) {
            $latestNumber = intval(substr($latestTicket->ticket_number, -4)) + 1;
        } else {
            $latestNumber = 1; // Jika belum ada tiket, mulai dari 0001
        }

        // Buat format nomor tiket
        return sprintf('TC/%s/%04d', $today, $latestNumber);
    }
}
