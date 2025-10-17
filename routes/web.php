<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ErroExecucaoController;
use App\Http\Controllers\EsclarecimentoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReciboController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipeController;
use App\Http\Controllers\ProcessosController;

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get("/teste", function() {
        return diasRestantes("2025-10-13");
    });

    Route::get('/user/registro', [RegisteredUserController::class, 'create'])
       ->name('create.user');
       Route::post('/user/registro/store', [RegisteredUserController::class, 'store'])
       ->name('register');

    Route::post('/user/update', [RegisteredUserController::class, 'update']);
    Route::post('/user/change-background', [UserController::class, 'changeBackground']);

    Route::get('/equipe', function () {
        return view('tecnicos.index');
    });
    Route::get('/equipe/getAll', [EquipeController::class, 'getAll']);
    Route::get('/equipe/create', function () {
        return view('tecnicos.create');
    });
    Route::post('/equipe/store', [EquipeController::class, 'store']);
    Route::get('/equipe/show/{id}', function () {
        return view('tecnicos.edit');
    });
    Route::get('/equipe/getById/{id}', [EquipeController::class, 'getById']);
    Route::post('/equipe/update', [EquipeController::class, 'update']);
    Route::get('/equipe/delete/{id}', [EquipeController::class, 'delete']);
    Route::get('/equipe/report', [EquipeController::class, 'report']);
    Route::get('/equipe/reportByProductivity', [EquipeController::class, 'reportByProductivity']);

    /** Rotas de Pagamento */
    Route::get('/pagamentos', function() { return view ('pagamentos.index');});
    Route::get('/pagamentos/getMonth/{month?}',[PagamentoController::class, 'getMonth']);
    /** Rotas Crud Processos */
    Route::get('/processos', function () {
        return view('processos.index');
    });
    Route::get('/processos/getAll', [ProcessosController::class, 'getAll']);
    Route::get('/processos/getProcessPerYear', [ProcessosController::class, 'getProcessPerYear']);

    Route::get('/processo/create', function () {
        return view('processos.create');
    });
    Route::post('/processo/store', [ProcessosController::class, 'store']);
    Route::get('/processo/show/{id}', function () {
        return view('processos.edit');
    });

    Route::get('/processo/getById/{id}', [ProcessosController::class, 'getById']);
    Route::get('/processo/getByDue', [ProcessosController::class, 'getByDue']);
    Route::post('/processos/inIds', [ProcessosController::class, 'inIds']);


    Route::post('/processo/update', [ProcessosController::class, 'update']);
    Route::get('/processo/delete/{id}', [ProcessosController::class, 'delete']);

    Route::post('/processo/pagamento/create', [PagamentoController::class, 'create']);
    Route::get('/processo/pagamento/rebibo/delete/{id}', [ReciboController::class, 'delete']);
    Route::get('/processo/pagamento/delete/{id}', [PagamentoController::class, 'delete']);

    Route::post('/processo/esclarecimento/create', [EsclarecimentoController::class, 'create']);
    Route::post('/processo/esclarecimento/update', [EsclarecimentoController::class, 'update']);
    Route::get('/processo/esclarecimento/delete/{id}', [EsclarecimentoController::class, 'delete']);


    Route::post('/processo/erro-execucao/create', [ErroExecucaoController::class, 'create']);
    Route::post('/processo/erro-execucao/update', [ErroExecucaoController::class, 'update']);
    Route::get('/processo/erro-execucao/delete/{id}', [ErroExecucaoController::class, 'delete']);




    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
