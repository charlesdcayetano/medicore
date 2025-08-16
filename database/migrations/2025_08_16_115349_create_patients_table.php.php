<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('patients', function (Blueprint $table) {
      $table->id();
      $table->string('first_name');
      $table->string('last_name');
      $table->date('date_of_birth')->nullable();
      $table->enum('gender', ['Male','Female','Other'])->nullable();
      $table->string('contact_number', 30)->nullable();
      $table->string('email')->nullable()->unique();
      $table->string('address')->nullable();
      $table->string('emergency_contact')->nullable();
      $table->timestamps();
      $table->index(['last_name','first_name']);
    });
  }
  public function down(): void { Schema::dropIfExists('patients'); }
};
