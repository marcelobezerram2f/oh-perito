<?php

namespace App\Http\Controllers;

use App\Repositories\ReciboRepository;
use Illuminate\Http\Request;

class ReciboController extends Controller
{

    private $reciboRepository;

    public function __construct()
    {
        $this->reciboRepository =  new ReciboRepository();
    }


    public function delete($id) {

        $response = $this->reciboRepository->delete($id);
        if(isset($response['code'])){
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

}
