<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Marcelgwerder\ApiHandler\Facades\ApiHandler;
use App\Venda;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{

    /**
     * @return \Marcelgwerder\ApiHandler\Result
     */
    public function index()
    {
        $receive = ApiHandler::parseMultiple(new Venda,['nome_vendedor','venda_item_id','desconto','cancelada','total']);
        // dump($receive);
        return $receive->getResult();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //FAZER FUNCIONAR ASSIM 
        //'desconto' => 'required|numeric|min:0|max:total',
        $this->validationForStoreAction($request, [
            'nome_vendedor' => 'required|string',
            'venda_item_id' => 'required|string',
            'desconto' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        
        $venda = Venda::create($request->all());
        return $this->apiHandler->created($venda);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ApiHandler::parseSingle(new Venda,$id);
        return $result->getResult();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validationForUpdateAction($request, [
            'nome_vendedor' => 'required|string',
            'venda_item_id' => 'required|string',
            'desconto' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);
        $venda = Venda::findOrFail($id);
        $venda->update($request->all());
        return $venda;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venda = Venda::findOrFail($id);
        $receive = $venda->delete();
        return $this->apiHandler->deleted();
    }
}
