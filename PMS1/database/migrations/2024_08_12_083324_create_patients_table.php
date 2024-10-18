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
        Schema::create('patients', function (Blueprint $table) {
            $table->id('patient_id');
            //
            $table->string('patient_type')->nullable()->comment('Inpatient, Outpatient');
            $table->string('first_name')->nullable()->fulltext();
            $table->string('middle_name')->nullable()->fulltext();
            $table->string('last_name')->nullable()->fulltext();
            $table->string('extension')->nullable()->fulltext();
            //
            $table->string('sex')->nullable()->comment('Male, Female');
            $table->string('civil_status')->nullable()->comment('Single, Divorce, Married');
            //
            $table->date('dob')->nullable()->comment('mm-dd-yyyy');
            //
            $table->string('phone')->nullable()->comment('because one phone number can be use for multiple patient from the same house');
            $table->string('email')->nullable()->comment('because one email can be use for multiple patient from the same house');
            $table->string('employment')->nullable()->comment('Employed, Unemployed, etc.');
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            //
            $table->text('street_address')->nullable();
            $table->text('street_address_2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip')->nullable();

            $table->string('patient_status')->nullable();

            $table->unsignedBigInteger('health_history_id')->nullable();
            $table->unsignedBigInteger('insurance_information_id')->nullable();
            $table->unsignedBigInteger('emergency_patient_id')->nullable();
            $table->unsignedBigInteger('emergency_contact_id')->nullable();

            $table->foreign('health_history_id')->references('health_history_id')->on('health_histories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('insurance_information_id')->references('insurance_information_id')->on('insurance_information')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emergency_patient_id')->references('emergency_patient_id')->on('emergency_patients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('emergency_contact_id')->references('emergency_contact_id')->on('emergency_contacts')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
