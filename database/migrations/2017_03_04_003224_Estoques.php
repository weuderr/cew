<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Estoques extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('produto_id')->unsigned()->index();
            $table->integer('fornecedor_id')->unsigned()->index();
            $table->integer('quantidade');
            $table->double('custo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('produto_id')->references('id')->on('produtos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estoques', function(Blueprint $table){
            $table->dropForeign(['produto_id']);
            $table->dropColumn('produto_id');
            $table->dropForeign(['fornecedor_id']);
            $table->dropColumn('fornecedor_id');
        });
        Schema::drop('estoques');
    }
}
