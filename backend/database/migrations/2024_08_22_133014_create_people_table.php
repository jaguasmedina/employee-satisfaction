<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->date('fecha');
            $table->string('correo')->unique();
            $table->string('area');
            $table->boolean('is_favorite')->default(false);
            $table->enum('categoria', ['Empleado', 'Directivo', 'Contratista']);
            $table->unsignedTinyInteger('nivel_de_satisfaccion');
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
        Schema::dropIfExists('people');
    }
}
