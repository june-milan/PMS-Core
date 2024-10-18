<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vital_signs', function (Blueprint $table) {
            $table->id('vital_signs_id');
            $table->date('diagnosis_date')->nullable()->comment('mm-dd-yyyy');
            $table->string('diagnosis_time', 8)->nullable()->comment('hh:mm am/pm');
            $table->string('B_P')->nullable();
            $table->string('heart_rate')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('temperature')->nullable();
            $table->string('oxygen_saturation')->nullable();
            $table->string('pain_scale')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('respiratory_pattern')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('bmi')->nullable();
            $table->text('vitals_note')->nullable();
            //
            $table->unsignedBigInteger('emergency_patient_id')->nullable();
            $table->foreign('emergency_patient_id')->references('emergency_patient_id')->on('emergency_patients')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vital_signs');
    }
};
