<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDebitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('debits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('debtor_id')->default(1);
            $table->foreign('debtor_id')->references('id')->on('debtor');
            $table->unsignedBigInteger('situation_id')->default(1);
            $table->foreign('situation_id')->references('id')->on('situations');
            $table->float('value',10,2);
            $table->date('due');
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
        Schema::table('debits', function (Blueprint $table) {
            $table->dropForeign('debits_debtor_id_foreign');
            $table->dropColumn('debtor_id');
            $table->dropForeign('debits_situation_id_foreign');
            $table->dropColumn('situation_id');

        });
        Schema::dropIfExists('debits');
    }
}
