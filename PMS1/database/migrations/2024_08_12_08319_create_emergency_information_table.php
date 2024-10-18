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
        Schema::create('emergency_information', function (Blueprint $table) {
            $table->id('emergency_information_id');
            $table->string('ep_nationality')->nullable();
            $table->string('ep_religion')->nullable();
            $table->string('ep_full_address')->nullable();
            $table->string('ep_phone')->nullable();
            $table->string('ep_civil_status')->nullable();
            $table->string('ep_employment')->nullable();
            $table->string('ep_email')->nullable()->comment('because one email can be use for multiple patient from the same house');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_information');
    }
};
