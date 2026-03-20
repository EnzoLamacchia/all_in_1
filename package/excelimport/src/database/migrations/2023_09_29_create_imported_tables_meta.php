<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('imported_tables_meta', function (Blueprint $table) {
            $table->id();
            $table->string('table_name')->unique();
            $table->json('schema');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imported_tables_meta');
    }
};
