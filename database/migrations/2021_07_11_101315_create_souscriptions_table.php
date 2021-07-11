<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSouscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('souscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('mise_id');
            $table->float('solde_final');
            $table->float('solde');
            $table->date('debut');
            $table->date('fin');
            $table->boolean('statut');
            $table->timestamps();
            $table->foreign('client_id')
                        ->references('id')
                        ->on('clients')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
            $table->foreign('mise_id')
                        ->references('id')
                        ->on('mises')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('souscriptions');
    }
}
