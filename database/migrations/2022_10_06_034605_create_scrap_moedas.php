<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScrapMoedas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('personal_access_tokens');
        Schema::create('scrap_moedas', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('moeda')->unique();
            $table->integer('numero');
            $table->float('casas_decimais');
            $table->text('nome_moeda');
            $table->text('locais');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scrap_moedas');
    }
}
