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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            
            // FORM 1: Personal Informations

            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('picture')->nullable();
            $table->string('dob')->nullable();
            $table->string('birth_certificate')->nullable();

            //FORM 2: Guidance INformations

            $table->string('father_name')->nullable();
            $table->string('father_tel')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_tel')->nullable();
            $table->string('tutor_name')->nullable();
            $table->string('tutor_tel')->nullable();
            $table->string('urgence_tel')->nullable();


            // FORM 3: Academic Background

            $table->string('school_name')->nullable();
            $table->enum('academic_background', ['GCE','BACC'])->nullable();

            // GCE
            $table->json('gce_alevel_papers')->nullable();
            $table->json('gce_alevel_grades')->nullable();
            $table->string('gce_alevel_slip')->nullable();
            $table->json('gce_olevel_papers')->nullable();
            $table->json('gce_olevel_grades')->nullable();
            $table->string('gce_olevel_slip')->nullable();

            // BACC
            $table->string('bacc_series')->nullable();
            $table->decimal('bacc_average', 5, 2)->nullable();
            $table->string('bacc_slip')->nullable();


            // FORM 4: Field Choice
            $table->string('field')->nullable();
            $table->string('speciality')->nullable();

            // FROM 5: Motivation
            $table->text('motivation_reason')->nullable();

            // FROM 6: Other Academic Background
            $table->text('other_background')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
