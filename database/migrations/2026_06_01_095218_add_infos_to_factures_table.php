<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfosToFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('factures', function (Blueprint $table) {

        $table->string('numero_facture')
              ->unique()
              ->nullable()
              ->after('id');

        $table->date('date_facture')
              ->nullable();

        $table->decimal('tva', 10, 2)
              ->default(0);

        $table->string('statut')
              ->default('Impayée');
    });
}

public function down()
{
    Schema::table('factures', function (Blueprint $table) {

        $table->dropColumn([
            'numero_facture',
            'date_facture',
            'tva',
            'statut'
        ]);
    });
}
}
