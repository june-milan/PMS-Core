<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('emergency_patients', function (Blueprint $table) {
            $table->id('emergency_patient_id');
            //
            // $table->string('patient_temporary_id')->unique()->nullable()->default(DB::raw('CONCAT("TEMP-", LPAD(FLOOR(RAND() * 999999), 6, "0"))'));
            $table->string('patient_temporary_id')->unique()->nullable();
            $table->date('emergency_date')->nullable()->comment('mm-dd-yyyy');
            $table->string('emergency_time', 8)->nullable()->comment('hh:mm am/pm');
            //
            $table->string('emergency_first_name')->nullable()->fulltext();
            $table->string('emergency_middle_name')->nullable()->fulltext();
            $table->string('emergency_last_name')->nullable()->fulltext();
            $table->string('emergency_extension')->nullable()->fulltext();
            //
            $table->date('emergency_dob')->nullable()->comment('mm-dd-yyyy');
            $table->string('emergency_sex')->nullable()->comment('Male, Female');
            $table->string('emergency_age')->nullable();
            $table->string('priority_level')->nullable();
            $table->string('status')->nullable();
            //
            // $table->unsignedBigInteger('vital_signs_id')->nullable();
            $table->unsignedBigInteger('emergency_information_id')->nullable();

            // $table->foreign('vital_signs_id')->references('vital_signs_id')->on('vital_signs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emergency_information_id')->references('emergency_information_id')->on('emergency_information')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_patients');
    }
};
