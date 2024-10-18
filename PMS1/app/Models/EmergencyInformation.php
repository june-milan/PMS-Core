<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyInformation extends Model
{
    use HasFactory;

    protected $table = 'emergency_information';

    protected $primaryKey = 'emergency_information_id';

    protected $guarded = [];

    public function emergency_patients()
    {
        return $this->hasMany(EmergencyPatient::class, 'emergency_information_id');
    }

}
