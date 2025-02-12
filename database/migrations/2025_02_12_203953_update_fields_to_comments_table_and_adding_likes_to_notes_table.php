<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('userId')->change();
            $table->unsignedBigInteger('noteId')->change();
            $table->bigInteger('likes')->default(0)->change();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->bigInteger('likes')->default(0);
        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->bigInteger('userId')->change();
            $table->bigInteger('noteId')->change();
            $table->bigInteger('likes')->nullable()->change();
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('likes');
        });
    }
};
