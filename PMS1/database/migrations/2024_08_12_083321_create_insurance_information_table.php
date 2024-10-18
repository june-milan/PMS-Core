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
        Schema::create('insurance_information', function (Blueprint $table) {
            $table->id('insurance_information_id');
            $table->string('primary_holder')->nullable()->comment('Yes, No');
            $table->string('insurance_company')->nullable()->fulltext();
            $table->string('insurance_number')->nullable()->fulltext();
            $table->date('effective_date')->nullable()->comment('mm-dd-yyyy');
            $table->date('expiration_date')->nullable()->comment('mm-dd-yyyy');
            $table->string('plan_type')->nullable();
            $table->string('holder_first_name')->nullable()->fulltext();
            $table->string('holder_last_name')->nullable()->fulltext();
            $table->date('holder_dob')->nullable()->comment('mm-dd-yyyy');
            $table->string('holder_phone')->nullable();
            $table->string('holder_email')->nullable();
            $table->text('holder_street_address')->nullable();
            $table->text('holder_street_address_2')->nullable();
            $table->text('holder_city')->nullable();
            $table->text('holder_state')->nullable();
            $table->text('holder_zip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_information');
    }
};
