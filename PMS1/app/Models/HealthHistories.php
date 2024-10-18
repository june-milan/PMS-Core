<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthHistories extends Model
{
    use HasFactory;

    protected $table = 'health_histories';

    protected $primaryKey = 'health_history_id';

    protected $guarded = [];

    protected $casts = [
        'family_history' => 'json',
    ];

    // Define the inverse relationship with the Patient model
    public function patients()
    {
        return $this->hasMany(Patient::class, 'health_history_id');
    }
}
