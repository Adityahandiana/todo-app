<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'deadline', 'user_id', 'completed', 'is_favorite'];
    public $timestamps = true; // Pastikan timestamps aktif

    // Relasi antara Task dan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi antara Task dan SubTask
    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }
    
}
