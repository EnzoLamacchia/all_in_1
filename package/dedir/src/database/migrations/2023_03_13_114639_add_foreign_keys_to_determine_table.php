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
    public function up()
    {
        Schema::table('determine', function (Blueprint $table) {
            $table->foreign(['Competenza_Id'], 'Competenza_Id')->references(['id'])->on('competenze')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('determine', function (Blueprint $table) {
            $table->dropForeign('Competenza_Id');
        });
    }
};
