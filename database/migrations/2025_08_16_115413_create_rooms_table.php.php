<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('rooms', function (Blueprint $table) {
      $table->id();
      $table->string('number')->unique();
      $table->string('type');
      $table->boolean('is_available')->default(true);
      $table->timestamps();
      $table->index('type');
    });
  }
  public function down(): void { Schema::dropIfExists('rooms'); }
};
