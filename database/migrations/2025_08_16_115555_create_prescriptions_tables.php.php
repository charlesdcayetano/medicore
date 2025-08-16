<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('prescriptions', function (Blueprint $table) {
      $table->id();
      $table->foreignId('medical_record_id')->constrained()->cascadeOnDelete();
      $table->date('prescribed_on');
      $table->timestamps();
    });

    Schema::create('prescription_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('prescription_id')->constrained()->cascadeOnDelete();
      $table->string('drug_name');
      $table->string('dosage')->nullable();
      $table->string('frequency')->nullable();
      $table->integer('days')->default(1);
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('prescription_items');
    Schema::dropIfExists('prescriptions');
  }
};
