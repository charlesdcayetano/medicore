<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::table('users', function (Blueprint $table) {
      $table->enum('role', ['Admin','Staff','Doctor','Patient'])->default('Staff')->after('password');
      $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
    });
  }
  public function down(): void {
    Schema::table('users', function (Blueprint $table) {
      $table->dropConstrainedForeignId('department_id');
      $table->dropColumn('role');
    });
  }
};
