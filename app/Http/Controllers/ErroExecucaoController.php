<?php

namespace App\Http\Controllers;

use App\Repositories\ErroExecucaoRepository;
use Illuminate\Http\Request;

class ErroExecucaoController extends Controller
{
    private $erroExecucaoRepository;


    public function __construct()
    {
        $this->erroExecucaoRepository =  new ErroExecucaoRepository();
    }


    public function create(Request $request)
    {
        $response = $this->erroExecucaoRepository->create($request->all());
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $response = $this->erroExecucaoRepository->update($request->all());
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }


    public function delete($id)
    {
        $response = $this->erroExecucaoRepository->delete($id);
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }
}
