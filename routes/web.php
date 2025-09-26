<?php

use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProfileController;
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

    /** Rotas de Pagamento */
    Route::get('/pagamentos', function() { return view ('pagamentos.index');});
    Route::get('/pagamentos/getMonth/{month?}',[PagamentoController::class, 'getMonth']);
    /** Rotas Crud Processos */
    Route::get('/processos', function () {
        return view('processos.index');
    });
    Route::get('/processos/getAll', [ProcessosController::class, 'getAll']);
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
