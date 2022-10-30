<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ots', function (Blueprint $table) {
            $table->id();
            $table->string('n_ot')->unique();

            $table->unsignedBigInteger('moteur_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('recepteur_id');
            $table->unsignedBigInteger('local_id');
            $table->unsignedBigInteger('testeur_id')->nullable();
            $table->string('noms_participants_test')->nullable();
            $table->string('preneur')->nullable();
            $table->string('emetteur')->nullable();
            $table->text('description')->nullable();

            $table->string('n_bobines')->nullable();
            $table->string('n_groupes')->nullable();
            $table->string('n_bobines_group')->nullable();
            $table->string('n_spires_bobine')->nullable();
            $table->integer('n_phases')->nullable();
            $table->integer('n_encouches')->nullable();
            $table->integer('n_poles')->nullable();
            $table->string('pas')->nullable();
            $table->string('n_fils_encouche')->nullable();

            $table->float('n_fil_1')->nullable();
            $table->float('n_fil_2')->nullable();
            $table->float('n_fil_3')->nullable();
            $table->float('n_fil_4')->nullable();
            $table->float('n_fil_5')->nullable();
            $table->float('n_fil_6')->nullable();
            $table->float('n_fil_7')->nullable();
            $table->float('n_fil_8')->nullable();
            $table->float('n_fil_9')->nullable();
            $table->float('n_fil_10')->nullable();

            $table->float('phase_test_a')->nullable();
            $table->float('phase_test_b')->nullable();
            $table->float('phase_test_c')->nullable();

            $table->text('travaux_effectues')->nullable();
            
            $table->date('date_reception');
            $table->date('date_essai')->nullable();
            $table->date('date_enlevement')->nullable();

            $table->boolean('rapport')->default(false);

            $table->string('statut')->default('En Attente');
            
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
        Schema::dropIfExists('ots');
    }
}
