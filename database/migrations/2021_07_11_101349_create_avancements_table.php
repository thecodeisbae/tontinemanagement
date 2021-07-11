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
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('mise_id');
            $table->boolean('statut')->default(false);
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
        Schema::dropIfExists('avancements');
    }
}
