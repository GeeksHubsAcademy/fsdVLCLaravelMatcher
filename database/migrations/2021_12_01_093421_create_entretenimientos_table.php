<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntretenimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entretenimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            //Clave foránea de user

            $table->unsignedBigInteger('iduser');
            $table->foreign('iduser', 'fk_entretenimientos_users')
            ->on('users')
            ->references('id')
            ->onDelete('restrict');

            //Clave foránea de hobbie

            $table->unsignedBigInteger('idhobbie');                  //id oferta suscrita
            $table->foreign('idhobbie', 'fk_entretenimientos_hobbies')   
            ->on('hobbies')
            ->references('id')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entretenimientos');
    }
}
