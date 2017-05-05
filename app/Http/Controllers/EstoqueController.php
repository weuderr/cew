<?php

namespace App\Http\Controllers;

use App\Estoque;
use Illuminate\Http\Request;
use Marcelgwerder\ApiHandler\Facades\ApiHandler;

class EstoqueController extends Controller
{
    /**
     * @return \Marcelgwerder\ApiHandler\Result
     */
    public function index()
    {
        $receive = ApiHandler::parseMultiple(new Estoque,['quantidade','custo','produto_id'/*,'fornecedor_id'*/]);
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
        $this->validationForStoreAction($request, [
            'quantidade' => 'required|integer',
            'custo' => 'required|numeric',
            'produto_id' => 'required|exists:produtos,id',
        ]);
        $estoque = Estoque::create($request->all());

        return $this->apiHandler->created($estoque);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ApiHandler::parseSingle(new Estoque,$id);
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
            'quantidade' => 'required|integer',
            'custo' => 'numeric',
            'produto_id' => 'exists:produtos,id',
        ]);
        $estoque = Estoque::findOrFail($id);
        $estoque->update($request->all());
        return $estoque;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $estoque = Estoque::findOrFail($id);
        $receive = $estoque->delete();
        return $this->apiHandler->deleted();
    }
}
