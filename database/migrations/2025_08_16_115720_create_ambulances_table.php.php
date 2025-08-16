<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('ambulances', function (Blueprint $table) {
      $table->id();
      $table->string('plate_number')->unique();
      $table->enum('status', ['Available','On Duty','Maintenance'])->default('Available');
      $table->string('driver_name')->nullable();
      $table->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('ambulances'); }
};
