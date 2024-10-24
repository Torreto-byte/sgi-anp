<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ChronoInController;
use App\Http\Controllers\Admin\ChronoOutController;
use App\Http\Controllers\Admin\DirectionController;
use App\Http\Controllers\Admin\LettersInController;
use App\Http\Controllers\Admin\TypeInstructionController;

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

/******************   ROUTE LOGIN ****************************************************************/
Route::get('/', [AuthController::class, 'index'])->name('loginPage');
Route::post('/authentificated', [AuthController::class, 'authenticate'])->name('connexion');


Route::middleware(['auth'])->group(function () {

    Route::prefix('administration')->group(function () {

        Route::get('/deconnexion', [AuthController::class, 'logout'])->name('deconnexion');

        /******************   ROUTE HOME ****************************************************************/
        Route::get('/dashboard', [HomeController::class, 'index'])->name('adminHomePage');

        /******************   ROUTE DIRECTION    ********************************************************/
        Route::resource('direction', DirectionController::class);


        /*********************   ROUTE CHRONO IN   *********************************************************/
        Route::resource('chrono-arrive', ChronoInController::class);


        /*********************   ROUTE CHRONO OUT   *********************************************************/
        Route::resource('chrono-depart', ChronoOutController::class);


        /*********************   ROUTE LETTERS IN   *********************************************************/
        Route::resource('type-instruction', TypeInstructionController::class);


        /*********************   ROUTE LETTERS IN   *********************************************************/
        Route::get('courriers-arrives/imputation/{id}', [LettersInController::class, 'imputation'])->name('imputation');
        Route::post('courriers-arrives/imputation/attribution', [LettersInController::class, 'saveImputation'])->name('saveImputation');
        Route::get('courriers-arrives/imputation/modifier/{id}', [LettersInController::class, 'editImputation'])->name('editImputation');
        Route::put('courriers-arrives/imputation/save/modifier/{id}', [LettersInController::class, 'updateImputation'])->name('saveEditImputation');
        Route::get('courriers-arrives/imputation/decharger/{id}', [LettersInController::class, 'editDechargeImputation'])->name('dechargeImputation');
        Route::put('courriers-arrives/imputation/save/decharge/{id}', [LettersInController::class, 'saveDechargeImputation'])->name('saveDechargeImputation');
        Route::resource('courriers-arrives', LettersInController::class);


        /*******************     ROUTE USERS     **************************************************************/
        Route::get('/utilisateurs/statut/{id}', [UsersController::class, 'status'])->name('statutUtulisateur');
        Route::get('/utilisateurs/motdepasseoublier/{id}', [UsersController::class, 'resetpassword'])->name('resetpasswordUtulisateur');
        Route::resource('utilisateurs', UsersController::class);



    });

});

