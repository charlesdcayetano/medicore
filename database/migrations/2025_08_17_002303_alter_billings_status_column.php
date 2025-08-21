<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('billings', function (Blueprint $table) {
        if (!Schema::hasColumn('billings', 'status')) {
            $table->string('status')->default('pending');
        }
    });
}

    public function down(): void
    {
        Schema::table('billings', function (Blueprint $table) {
            if (Schema::hasColumn('billings', 'status')) {
                $table->dropColumn('status');
            }
        });
}};
