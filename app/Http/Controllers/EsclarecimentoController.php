<?php

namespace App\Http\Controllers;

use App\Repositories\EsclarecimentoRepository;
use Illuminate\Http\Request;

class EsclarecimentoController extends Controller
{
    private $esclarecimentorepository;

    public function __construct()
    {
        $this->esclarecimentorepository = new EsclarecimentoRepository();
    }


    public function create(Request $request)
    {
        $response = $this->esclarecimentorepository->create($request->all());
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $response = $this->esclarecimentorepository->update($request->all());
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }


    public function delete($id)
    {
        $response = $this->esclarecimentorepository->delete($id);
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }



}
