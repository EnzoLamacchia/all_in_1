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
        Schema::create('competenze', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('competenzaComp', 128)->unique('competenzaComp_UNIQUE');
            $table->string('competenzaAbbr', 64)->nullable();
            $table->tinyInteger('attivo')->nullable()->default(1);
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();
            $table->date('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competenze');
    }
};
