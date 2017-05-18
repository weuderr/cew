<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Estoque;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EstoqueControllerTest extends TestCase
{
    /**
     * @covers App\Http\Controllers\EstoqueController::index
     *
     * @return void
     */
    public function testIndex()
    {
        $estoque = factory(Estoque::class)->create();

        $json = [
            "total" => 3,
            "per_page" => 15,
            "current_page" => 1,
            "last_page" => 1,
            "next_page_url" => null,
            "prev_page_url" => null,
            "from" => 1,
            "to" => 3,
            "data" => $estoque->toArray()
        ];

        $this->get('estoques',$json)->assertStatus(200);
    }

    /**
     * @covers App\Http\Controllers\EstoqueController::store
     *
     * @return void
     */
    public function testStore()
    {
        $estoque = factory(Estoque::class)->make()->toArray();
        
        $this->post('estoques',$estoque)->assertStatus(201);
    }


    /**
     * @covers App\Http\Controllers\EstoqueController::show
     *
     * @return void
     */
    public function testShow()
    {
    	$estoque = factory(Estoque::class)->create();
    	
        $this->get("estoques/{$estoque->id}")
        	->assertStatus(200);
    }
    /**
     * @covers App\Http\Controllers\EstoqueController::destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $estoque = factory(Estoque::class)->create();
        $this->delete("estoques/{$estoque->id}",[])
            ->assertStatus(204);
    }
    /**
     * @covers App\Http\Controllers\EstoqueController::update
     *
     * @return void
     */
    public function testUpdate()
    {
        $estoque = factory(Estoque::class)->create();
        $estoque_changed = factory(Estoque::class)->make()->toArray();
        $this->put("estoques/{$estoque->id}", $estoque_changed)
            ->assertStatus(200);
    }
}
