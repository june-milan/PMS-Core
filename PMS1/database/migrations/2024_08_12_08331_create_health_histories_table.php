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
        Schema::create('health_histories', function (Blueprint $table) {
            $table->id('health_history_id');
            $table->text('reason_registration')->nullable();
            $table->text('additional_note')->nullable();
            $table->string('history_operation')->nullable()->comment('Yes, No');
            $table->text('history_note')->nullable();
            $table->string('current_condition')->nullable()->comment('Yes, No');
            $table->text('condition_note')->nullable();
            $table->string('taking_medications')->nullable()->comment('Yes, No');
            $table->text('medications_note')->nullable();
            $table->string('food_allergy')->nullable()->comment('Yes, No');
            $table->text('food_allergy_note')->nullable();
            $table->string('drug_allergy')->nullable()->comment('Yes, No');
            $table->text('drug_allergy_note')->nullable();
            $table->string('patient_smoke')->nullable()->comment('Yes, No');
            $table->string('patient_alcohol')->nullable()->comment('Yes, No');
            $table->string('family_history')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_histories');
    }
};
