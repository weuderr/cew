<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Venda;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class VendaControllerTest extends TestCase
{
    /**
     * @covers App\Http\Controllers\VendaController::index
     *
     * @return void
     */
    public function testIndex()
    {
        $venda = factory(Venda::class)->create();

        $json = [
            "total" => 3,
            "per_page" => 15,
            "current_page" => 1,
            "last_page" => 1,
            "next_page_url" => null,
            "prev_page_url" => null,
            "from" => 1,
            "to" => 3,
            "data" => $venda->toArray()
        ];

        $this->get('vendas',$json)
        	// ->assertJson($json)
        	->assertStatus(200);
    }

    /**
     * @covers App\Http\Controllers\VendaController::store
     *
     * @return void
     */
    public function testStore()
    {
        $venda = factory(Venda::class)->make()->toArray();
        
        $this->post('vendas',$venda)->assertStatus(201);
    }


    /**
     * @covers App\Http\Controllers\VendaController::show
     *
     * @return void
     */
    public function testShow()
    {
    	$venda = factory(Venda::class)->create();
    	
        $this->get("vendas/{$venda->id}")
        	->assertStatus(200);
    }
    /**
     * @covers App\Http\Controllers\VendaController::destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $venda = factory(Venda::class)->create();
        $this->delete("vendas/{$venda->id}",[])
            ->assertStatus(204);
    }
    /**
     * @covers App\Http\Controllers\VendaController::update
     *
     * @return void
     */
    public function testUpdate()
    {
        $venda = factory(Venda::class)->create();
        $venda_changed = factory(Venda::class)->make()->toArray();
        $this->put("vendas/{$venda->id}", $venda_changed)
            ->assertStatus(200);
    }
}
