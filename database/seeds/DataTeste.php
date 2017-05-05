<?php

use Illuminate\Database\Seeder;

class DataTeste extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Produto::class, 5)->create();
        factory(App\Estoque::class, 20)->create();
        factory(App\Venda::class, 40)->create();
        // factory(App\VendaItem::class, 40)->create();
    }
}
