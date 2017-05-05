<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Marcelgwerder\ApiHandler\Facades\ApiHandler;
use App\VendaItem;
use Illuminate\Support\Facades\DB;

class VendaItemController extends Controller
{

    /**
     * @return \Marcelgwerder\ApiHandler\Result
     */
    public function index()
    {
        $receive = ApiHandler::parseMultiple(new VendaItem,['estoque_id','quantidade','valor','sub_total']);
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
        // $request['venda_id'] = DB::table('vendas')->max("venda_id") + 1;

        $this->validationForStoreAction($request, [
            'estoque_id' => 'required|integer',
            'quantidade' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
        ]);
        
        $vendaItem = VendaItem::create($request->all());
        return $this->apiHandler->created($vendaItem);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ApiHandler::parseSingle(new VendaItem,$id);
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
            'estoque_id' => 'required|integer',
            'quantidade' => 'required|integer|min:1',
            'valor' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
        ]);
        $vendaItem = VendaItem::findOrFail($id);
        $vendaItem->update($request->all());
        return $vendaItem;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendaItem = VendaItem::findOrFail($id);
        $receive = $vendaItem->delete();
        return $this->apiHandler->deleted();
    }
}
