<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;
use Marcelgwerder\ApiHandler\Facades\ApiHandler;

class ProdutoController extends Controller
{

    /**
     * @return \Marcelgwerder\ApiHandler\Result
     */
    public function index()
    {
        $receive = ApiHandler::parseMultiple(new Produto,['nome']);

//        $receive = view('produto', ['produto' => $receive->getResult()]);

        return $receive->getResult();
//        return $receive;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!empty($request)) {
            $this->validationForStoreAction($request, [
                'nome' => 'required|max:60'
            ]);
        }

        $produto = Produto::create($request->all());

        return $this->apiHandler->created($produto);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ApiHandler::parseSingle(new Produto,$id);
        // $this->validationForUpdateAction($id, [
        //     'id' => 'required|integer',
        //     'nome' => 'required|max:60'
        // ]);
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
            'nome' => 'required|max:60'
        ]);
        $produto = Produto::findOrFail($id);
        $produto->update($request->all());
        return $produto;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $receive = $produto->delete();
        return $this->apiHandler->deleted();
    }
}
