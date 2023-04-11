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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('title');
            $table->string('personal_email');
            $table->string('work_email')->nullable();
            $table->string('ssn')->unique();
            $table->timeTz('schedule_start')->nullable();
            $table->timeTz('schedule_end')->nullable();
            $table->integer('salary');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->timestamp('hire_date');
            $table->timestamp('termination_date');
            $table->string('termination_reason');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('employees');
    }
};
