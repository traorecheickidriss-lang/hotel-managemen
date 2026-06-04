<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('factures', function (Blueprint $table) {

        $table->id();

        $table->foreignId('reservation_id')
              ->constrained()
              ->onDelete('cascade');

        $table->integer('nombre_nuits');

        $table->decimal('montant_total', 10, 2);

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
        Schema::dropIfExists('factures');
    }
}
