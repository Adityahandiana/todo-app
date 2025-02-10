<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = [
        'description',
        'completed',
        'task_id', // Foreign key untuk menghubungkan ke Task
    ];

    // Tipe data untuk kolom tertentu
    protected $casts = [
        'completed' => 'boolean',
    ];

    // Relasi banyak ke satu dengan Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
