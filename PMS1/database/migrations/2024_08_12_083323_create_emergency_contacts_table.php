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
        Schema::create('emergency_contacts', function (Blueprint $table) {
            $table->id('emergency_contact_id');
            //
            $table->string('emergency_first_name')->nullable();
            $table->string('emergency_middle_name')->nullable();
            $table->string('emergency_last_name')->nullable();
            $table->string('relationship')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('emergency_phone_2')->nullable();
            $table->string('emergency_email')->nullable()->comment('because one email can be use for multiple patient from the same house');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contacts');
    }
};
