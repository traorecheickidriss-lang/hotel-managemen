<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaiementFieldsToFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
{
    Schema::table('factures', function ($table) {

        $table->string('mode_paiement')
              ->nullable();

        $table->date('date_paiement')
              ->nullable();

    });
}

public function down()
{
    Schema::table('factures', function ($table) {

        $table->dropColumn([
            'mode_paiement',
            'date_paiement'
        ]);

    });
}
}
