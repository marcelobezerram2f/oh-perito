<?php

namespace App\Http\Controllers;

use App\Repositories\EquipeRepository;
use Illuminate\Http\Request;

class EquipeController extends Controller
{


    private $equipeRepository;

    public function __construct()
    {
        $this->equipeRepository =  new EquipeRepository();
    }


    public function getAll()
    {
        $response  =  $this->equipeRepository->getAll();
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function store(Request $request)
    {
        $response  =  $this->equipeRepository->create($request->all());
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function getById($id)
    {
        $response  =  $this->equipeRepository->getById($id);
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }
    public function update(Request $request)
    {
        $response  =  $this->equipeRepository->update($request->all());
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }
    public function delete($id)
    {
        $response  =  $this->equipeRepository->delete($id);
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }


    public function report() {
        $response  =  $this->equipeRepository->failReport();
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }
}
