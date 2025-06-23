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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('uid')->unique(); // ID externo único del API
            $table->string('title');
            $table->text('description')->nullable();

            // Organización
            $table->string('organization_name')->nullable();
            $table->text('organization_desc')->nullable();

            // Ubicación
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('area')->nullable();
            $table->string('locality')->nullable();
            $table->string('district')->nullable();
            $table->string('street_address')->nullable();
            $table->string('postal_code')->nullable();

            // Otros
            $table->string('link')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
