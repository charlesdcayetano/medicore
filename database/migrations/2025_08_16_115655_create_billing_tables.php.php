<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('billings', function (Blueprint $table) {
      $table->id();
      $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
      $table->foreignId('appointment_id')->nullable()->constrained()->nullOnDelete();
      $table->decimal('total_amount', 12, 2)->default(0);
      $table->enum('status',['Pending','Unpaid','Partially Paid','Paid','Voided'])->default('Pending');
      $table->date('due_date')->nullable();
      $table->timestamps();
      $table->index(['patient_id','status']);
    });

    Schema::create('billing_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('billing_id')->constrained()->cascadeOnDelete();
      $table->string('description');
      $table->integer('quantity')->default(1);
      $table->decimal('unit_price', 12, 2);
      $table->decimal('line_total', 12, 2);
      $table->timestamps();
    });
  }
  public function down(): void {
    Schema::dropIfExists('billing_items');
    Schema::dropIfExists('billings');
  }
};
