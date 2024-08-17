<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTicket extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang bisa diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi ke model `Ticket`.
     * Kategori bisa memiliki banyak tiket.
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'category_id');
    }
}
