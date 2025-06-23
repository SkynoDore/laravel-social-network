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

            Schema::table('notes', function (Blueprint $table) {
            $table->string('category')->default('General');
            $table->foreignId('group_id')
                  ->nullable()
                  ->constrained('groups')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
            $table->dropColumn('category');
        });
    }
};
