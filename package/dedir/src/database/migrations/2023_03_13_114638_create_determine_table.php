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
        Schema::create('determine', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('DataProgr', 9)->nullable();
            $table->integer('NrDet');
            $table->date('DataDetD');
            $table->string('Competenza', 128);
            $table->integer('Competenza_Id')->nullable()->index('id_idx');
            $table->string('Oggetto', 1000);
            $table->date('PubbDAD')->nullable();
            $table->date('PubbAD')->nullable();
            $table->string('NomeFilePDF_1', 128)->nullable();
            $table->string('NomeFileT_1', 64)->nullable();
            $table->string('Impegno', 128)->nullable();
            $table->string('Ex', 32)->nullable();
            $table->date('DataImpegnoD')->nullable();
            $table->string('Note', 512)->nullable();
            $table->string('NrProgr', 8)->nullable();
            $table->date('updated_at')->nullable();
            $table->date('created_at')->nullable();
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
        Schema::dropIfExists('determine');
    }
};
