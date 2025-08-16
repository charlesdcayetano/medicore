<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('inventory_items', function (Blueprint $table) {
      $table->id();
      $table->string('name')->index();
      $table->string('sku')->unique();
      $table->integer('stock')->default(0);
      $table->decimal('unit_price', 10, 2)->default(0);
      $table->date('expires_at')->nullable();
      $table->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('inventory_items'); }
};
