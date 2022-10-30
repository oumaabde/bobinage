<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoteursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moteurs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marque_id');
            $table->unsignedBigInteger('unite_id');
            $table->unsignedBigInteger('user_id');
            $table->string('n_serie')->unique();

            $table->float('puissance');
            $table->float('courant');
            $table->float('vitesse')->nullable();
            $table->float('frequence');
            $table->float('tension');
            $table->float('cosph')->nullable();

            $table->string('roulement_a')->nullable();
            $table->string('roulement_b')->nullable();

            $table->string('couplage')->nullable();

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
        Schema::dropIfExists('moteurs');
    }
}
