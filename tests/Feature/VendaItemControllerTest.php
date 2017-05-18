<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\VendaItem;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VendaItemControllerTest extends TestCase
{

    /**
     * @covers App\Http\Controllers\VendaItemController::index
     *
     * @return void
     */
    public function testIndex()
    {
        $vendaItem = factory(VendaItem::class)->create();

        $json = [
            "total" => 3,
            "per_page" => 15,
            "current_page" => 1,
            "last_page" => 1,
            "next_page_url" => null,
            "prev_page_url" => null,
            "from" => 1,
            "to" => 3,
            "data" => $vendaItem->toArray()
        ];

        $this->get('venda_items',$json)
        	// ->assertJson($json)
        	->assertStatus(200);
    }

    /**
     * @covers App\Http\Controllers\VendaItemController::store
     *
     * @return void
     */
    public function testStore()
    {
        $vendaItem = factory(VendaItem::class)->make()->toArray();

        $this->post('venda_items',$vendaItem)->assertStatus(201);
    }


    /**
     * @covers App\Http\Controllers\VendaItemController::show
     *
     * @return void
     */
    public function testShow()
    {
    	$vendaItem = factory(VendaItem::class)->create();
    	
        $this->get("venda_items/{$vendaItem->id}")
        	->assertStatus(200);
    }
    /**
     * @covers App\Http\Controllers\VendaItemController::destroy
     *
     * @return void
     */
    public function testDestroy()
    {
        $vendaItem = factory(VendaItem::class)->create();
        $this->delete("venda_items/{$vendaItem->id}",[])
            ->assertStatus(204);
    }
    /**
     * @covers App\Http\Controllers\VendaItemController::update
     *
     * @return void
     */
    public function testUpdate()
    {
        $vendaItem = factory(VendaItem::class)->create();
        $vendaItem_changed = factory(VendaItem::class)->make()->toArray();
        $this->put("venda_items/{$vendaItem->id}", $vendaItem_changed)
            ->assertStatus(200);
    }
}
