<?php

namespace App\Http\Controllers;

use App\Repositories\PagamentosRepository;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    private $pagamentoRepository;

    public function __construct()
    {
        $this->pagamentoRepository = new PagamentosRepository();
    }


    public function getMonth($month = null)
    {
        $response  =  $this->pagamentoRepository->getMonth($month);
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }

        return response()->json($response, $code);

    }
}
