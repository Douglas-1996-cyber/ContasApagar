<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->default(1);
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('situation_id')->default(1);
            $table->foreign('situation_id')->references('id')->on('situations');
            $table->string('origin', 50);
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
        Schema::table('bills', function (Blueprint $table) {
            $table->dropForeign('bills_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('bills_situation_id_foreign');
            $table->dropColumn('situation_id');

        });
        Schema::dropIfExists('bills');
    }
}
