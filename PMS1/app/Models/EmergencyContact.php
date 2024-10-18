<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $table = 'emergency_contacts';

    protected $primaryKey = 'emergency_contact_id';

    protected $guarded = [];

    public function patients()
    {
        return $this->hasMany(Patient::class, 'emergency_contact_id');
    }
}
