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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            /** En esta llave foreana le indicamos a laravel que el id de los follower
             * los va a relacionar con el id de los usuarios; al constrained se le pasa la tabla
             * users por que en la BD no existe como tal la tabla follower a comparación de la línea de arriba
             * por defecto en la convencion de laravel, ya sabe que habrá una tabla de users.
             */
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('followers');
    }
};
