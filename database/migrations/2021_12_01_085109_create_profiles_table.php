<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('paypal');
            $table->string('foto');
            $table->boolean('paid');
            $table->string('nick')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('iduser');            //id usuario
            $table->foreign('iduser', 'fk_profiles_users')
            ->on('users')
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
        Schema::dropIfExists('profiles');
    }
}
