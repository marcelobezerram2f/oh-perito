<?php

namespace App\Http\Controllers;

use App\Repositories\ProcessosRepository;
use Illuminate\Http\Request;

class ProcessosController extends Controller
{
    //

    private $processosRepository;

    public function __construct()
    {
        $this->processosRepository =  new ProcessosRepository();
    }

    public function getAll()
    {
        $response  =  $this->processosRepository->getAll();
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function store(Request $request)
    {
        $response  =  $this->processosRepository->create($request->all());
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function getById($id)
    {
        $response  =  $this->processosRepository->getById($id);
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function inIds(Request $request)
    {
        $response  =  $this->processosRepository->inIds($request->all());
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function getByDue()
    {
        $response  =  $this->processosRepository->getByDue();
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $response  =  $this->processosRepository->update($request->all());
        if(isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }
}
