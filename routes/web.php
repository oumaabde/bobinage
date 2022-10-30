<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\MoteurController;
use App\Http\Controllers\OtController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\UniteController;
use App\Http\Controllers\UserController;
use App\Models\Moteur;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('users/export/', [UserController::class, 'export']);
Route::get('users/import/', [UserController::class, 'import']);


/*Route::get('moteurs', function () {
    return Moteur::with('unite','marque','ots')->get();
});*/


Route::resources([
    'agents' => AgentController::class,
    'moteurs' => MoteurController::class,
    'ots' => OtController::class,
    'rapports' => RapportController::class,
    'marques' => MarqueController::class,
    'locals' => LocalController::class,
    'unites' => UniteController::class,
]);

/* Route::get('local/add', [LocalController::class, 'create'])->name('local-add');
Route::get('locals/{local}/update', [LocalController::class, 'edit'])->name('local-update');

Route::get('marque/add', [MarqueController::class, 'create'])->name('marque-add');
Route::get('marques/{marque}/update', [MarqueController::class, 'edit'])->name('marque-update');

Route::get('moteur/add', [MoteurController::class, 'create'])->name('moteur-add');
Route::get('moteurs/{moteur}/update', [MoteurController::class, 'edit'])->name('moteur-update');

Route::get('ot/add', [OtController::class, 'create'])->name('ot-add');
Route::get('ot/{ot}/update', [OtController::class, 'edit'])->name('ot-update');

Route::get('rapport/add', [RapportController::class, 'create'])->name('rapport-add');
Route::get('rapports/{rapport}/update', [RapportController::class, 'edit'])->name('rapport-update');

Route::get('unite/add', [UniteController::class, 'create'])->name('unite-add');
Route::get('unites/{unite}/update', [UniteController::class, 'edit'])->name('unite-update'); */


Route::get('/dashboard', [OtController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard'); */

require __DIR__.'/auth.php';
