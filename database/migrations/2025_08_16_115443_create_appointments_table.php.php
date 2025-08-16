<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('appointments', function (Blueprint $table) {
      $table->id();
      $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
      $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();
      $table->foreignId('department_id')->constrained()->cascadeOnDelete();
      $table->foreignId('room_id')->nullable()->constrained()->nullOnDelete();
      $table->dateTime('scheduled_at');
      $table->enum('status', ['Pending','Confirmed','Completed','Cancelled'])->default('Pending');
      $table->text('notes')->nullable();
      $table->timestamps();
      $table->index(['doctor_id','scheduled_at']);
    });
  }
  public function down(): void { Schema::dropIfExists('appointments'); }
};
