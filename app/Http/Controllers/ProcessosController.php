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
        $this->processosRepository = new ProcessosRepository();
    }

    public function getAll(Request $request)
    {
        $data = [
            'numero_processo' => $request->get('numero_processo'),
            'prazo' => $prazo = $request->get('prazo'),
            'equipe_id' => $equipe_id = $request->get('equipe_id'),
            'reclamante_reclamado' => trim($request->get('reclamante_reclamado'))
        ];


        $response = $this->processosRepository->getAll($data);
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function store(Request $request)
    {
        $response = $this->processosRepository->create($request->all());
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function getById($id)
    {
        $response = $this->processosRepository->getById($id);
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function inIds(Request $request)
    {
        $response = $this->processosRepository->inIds($request->all());
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function getByDue()
    {
        $response = $this->processosRepository->getByDue();
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function update(Request $request)
    {
        $response = $this->processosRepository->update($request->all());
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }

    public function delete($id)
    {
        $response = $this->processosRepository->delete($id);
        if (isset($response['code'])) {
            $code = $response['code'];
        } else {
            $code = 200;
        }
        return response()->json($response, $code);
    }
}
