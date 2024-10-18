<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyPatient extends Model
{
    use HasFactory;

    protected $table = 'emergency_patients';

    protected $primaryKey = 'emergency_patient_id';

    protected $guarded = [];

    public function emergency_information()
    {
        return $this->belongsTo(EmergencyInformation::class, 'emergency_information_id');
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'emergency_patient_id');
    }

    public function vital_signs()
    {
        return $this->hasMany(VitalSigns::class, 'emergency_patient_id');
    }
}
