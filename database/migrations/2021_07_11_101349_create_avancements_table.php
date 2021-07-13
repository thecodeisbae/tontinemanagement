<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvancementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('avancements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('souscription_id');
            $table->boolean('statut')->default(false);
            $table->timestamps();
            $table->foreign('souscription_id')
                        ->references('id')
                        ->on('souscriptions')
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
        Schema::dropIfExists('avancements');
    }
}
