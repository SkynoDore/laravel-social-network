<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDescriptionLengthInNotesTable extends Migration
{
    public function up()
    {
        Schema::table('notes', function (Blueprint $table) {
            // Cambiar el tamaño de la columna a TEXT (sin límite de 191)
            $table->text('description')->change();
        });
        Schema::table('notes', function (Blueprint $table) {
            // Cambiar el tamaño de la columna a TEXT (sin límite de 191)
            $table->text('title')->change();
        });
    }

    public function down()
    {
        Schema::table('notes', function (Blueprint $table) {
            // Revertir el cambio al tamaño original
            $table->string('description')->change();
            $table->string('title')->change();
        });
    }
}
