<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceInformation extends Model
{
    use HasFactory;

    protected $table = 'insurance_information';

    protected $primaryKey = 'insurance_information_id';

    protected $guarded = [];

    // Define the inverse relationship with the Patient model
    public function patients()
    {
        return $this->hasMany(Patient::class, 'insurance_information_id');
    }
}
