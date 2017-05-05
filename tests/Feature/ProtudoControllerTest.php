<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Produto;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;

class ProtudoControllerTest extends TestCase
{
    /**
     * @covers App\Http\Controllers\ProdutoController::index
     *
     * @return void
     */
    public function testIndex()
    {
        $produto = factory(Produto::class)->create();

        $id = $produto->id;

        $json = [
            "total" => 3,
            "per_page" => 15,
            "current_page" => 1,
            "last_page" => 1,
            "next_page_url" => null,
            "prev_page_url" => null,
            "from" => 1,
            "to" => 3,
            "data" => $produto->toArray()
        ];

        $this->get('produtos',$json)->assertStatus(200);
    }

    /**
     * @covers App\Http\Controllers\ProdutoController::store
     *
     * @return void
     */
    public function testStore()
    {
        $produto = factory(Produto::class)->make()->toArray();

        $this->post('produtos',$produto)->assertStatus(201);
    }


    /**
     * @covers App\Http\Controllers\ProdutoController::show
     *
     * @return void
     */
    public function testShow()
    {
    	$produto = factory(Produto::class)->create();
    	
        $this->get("produtos/{$produto->id}")
        	->assertStatus(200);
    }
    /**
     * @covers App\Http\Controllers\ProdutoController::destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $produto = factory(Produto::class)->create();
        $this->delete("produtos/{$produto->id}",[])
            ->assertStatus(204);
    }
    /**
     * @covers App\Http\Controllers\ProdutoController::update
     *
     * @return void
     */
    public function testUpdate()
    {
        $produto = factory(Produto::class)->create();
        $produto_changed = factory(Produto::class)->make()->toArray();
        $this->put("produtos/{$produto->id}", $produto_changed)
            ->assertStatus(200);
    }
}
