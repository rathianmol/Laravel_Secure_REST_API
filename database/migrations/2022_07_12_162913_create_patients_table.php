<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            /** Personal Information */
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->char('gender', 1);
            $table->date('date_of_birth');
            /** END Personal Information */

            /** Contact Information */
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('ssn')->unique()->nullable();
            /** END Contact Information */

            /** Address Information  */
            $table->string('street');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            /** END Address Information  */

            /** Case Description  */
            $table->text('case_description');
            /** END Case Description  */

            /** Medical Information */
                /**Allergies */
            $table->text('food_allergies')->nullable();
            $table->text('medicine_allergies')->nullable();
            $table->text('insect_allergies')->nullable();
            $table->text('other_allergies')->nullable();
                /**END Allergies */

                /**Illnesses */
            $table->text('previous_illnesses')->nullable();
            $table->text('current_illnesses')->nullable();
                /** END Illnesses */

                /**Physical */
            $table->text('physical_disabilities')->nullable();
            $table->text('respitory_condition')->nullable();
            $table->text('heart_condition')->nullable();
            $table->text('hearing_condition')->nullable();
            $table->text('visual_condition')->nullable();
            $table->text('siezures')->nullable();
            $table->text('current_medications')->nullable();
                /**END Physical */
            /** END Medical Information */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
