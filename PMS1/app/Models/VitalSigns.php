<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalSigns extends Model
{
    use HasFactory;

    protected $table = 'vital_signs';

    protected $primaryKey = 'vital_signs_id';

    protected $guarded = [];

    // Define the inverse relationship with the Emergency_patient model
    public function emergency_patients()
    {
        return $this->belongsTo(EmergencyPatient::class, 'emergency_patient_id');
    }
}
