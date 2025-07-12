<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutSchedule extends Model
{
    // Untuk kompatibilitas dengan controller CRUD
    protected $fillable = [
        'user_id',
        'nama_workout',
        'hari',
        'waktu',
        'durasi',
        'jenis_olahraga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
