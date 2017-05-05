<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->integer('estoque_id')->unsigned()->index();
            $table->integer('quantidade');
            $table->double('valor');
            $table->double('sub_total');
            $table->double('troca');
            $table->double('cancelada');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('estoque_id')->references('id')->on('estoques');

        });
        //cada item de venda_item_id e uma chave estrangeira de venda_itens
        Schema::create('vendas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->string('nome_vendedor');
            $table->string('venda_item_id');
            $table->double('desconto');
            $table->double('cancelada');
            $table->double('total');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('venda_items', function(Blueprint $table){
            $table->dropForeign(['estoque_id']);
            $table->dropColumn('estoque_id');
        });
        Schema::drop('venda_items');
        Schema::drop('vendas');
    }
}
