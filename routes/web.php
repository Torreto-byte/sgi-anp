<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArchivesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Admin\ChronoInController;
use App\Http\Controllers\Admin\ChronoOutController;
use App\Http\Controllers\Admin\DirectionController;
use App\Http\Controllers\Admin\LettersInController;
use App\Http\Controllers\Admin\LettersOutController;
use App\Http\Controllers\Admin\TypeInstructionController;
use App\Http\Controllers\AgentCourrier\DashboardAgentCourrierController;
use App\Http\Controllers\AgentCourrier\ChronoInController as AgentCourrierChronoIn;
use App\Http\Controllers\AgentCourrier\LettersInController as AgentCourrierLetterIn;
use App\Http\Controllers\AgentCourrier\ChronoOutController as AgentCourrierChronoOut;
use App\Http\Controllers\AgentCourrier\LettersOutController as AgentCourrierLetterOut;

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

/*******************************   ROUTE LOGIN *************************************************/
Route::get('/', [AuthController::class, 'index'])->name('loginPage');
Route::post('/authentificated', [AuthController::class, 'authenticate'])->name('connexion');


Route::middleware(['auth'])->group(function () {

    Route::post('/notifications/mark-as-read', [NotificationsController::class, 'markAsRead'])->name('notifications.markAsRead');

    Route::get('/deconnexion', [AuthController::class, 'logout'])->name('deconnexion');


    /******************************* ARCHIVES COURRIERS  ******************************************/
    Route::get('/archives/courriers-arrives', [ArchivesController::class, 'arrives'])->name('archiveArrive');
    Route::get('/archives/courriers-arrives/details/{id}', [ArchivesController::class, 'arrivesDetails'])->name('archiveDetailsArrive');
    Route::get('/archives/courriers-departs', [ArchivesController::class, 'departs'])->name('archiveDepart');
    Route::get('/archives/courriers-departs/details/{id}', [ArchivesController::class, 'departsDetails'])->name('departDetailsArrive');

    Route::get('/public/archives/courriers-arrives', [ArchivesController::class, 'publicArrives'])->name('archiveArrivePublic');
    Route::get('/public/archives/courriers-arrives/details/{id}', [ArchivesController::class, 'publicArrivesDetails'])->name('archiveDetailsArrivePublic');
    Route::get('/public/archives/courriers-departs', [ArchivesController::class, 'publicDeparts'])->name('archiveDepartPublic');
    Route::get('/public/archives/courriers-departs/details/{id}', [ArchivesController::class, 'publicDepartsDetails'])->name('departDetailsArrivePublic');

    /******************************* ADMINIs ROUTE   **********************************************/
    Route::prefix('administration')->group(function () {

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
        Route::get('/courriers-arrives/imputation/{id}', [LettersInController::class, 'imputation'])->name('imputation');
        Route::post('/courriers-arrives/imputation/attribution', [LettersInController::class, 'saveImputation'])->name('saveImputation');
        Route::get('/courriers-arrives/imputation/modifier/{id}', [LettersInController::class, 'editImputation'])->name('editImputation');
        Route::put('/courriers-arrives/imputation/save/modifier/{id}', [LettersInController::class, 'updateImputation'])->name('saveEditImputation');
        Route::get('/courriers-arrives/imputation/decharger/{id}', [LettersInController::class, 'editDechargeImputation'])->name('dechargeImputation');
        Route::put('/courriers-arrives/imputation/save/decharge/{id}', [LettersInController::class, 'saveDechargeImputation'])->name('saveDechargeImputation');
        Route::get('/courriers-arrives/classer/{id}', [LettersInController::class, 'classerLetter'])->name('classer');
        Route::resource('courriers-arrives', LettersInController::class);


        /*********************   ROUTE LETTERS OUTS   *********************************************************/
        Route::get('/courriers-departs/classer/{id}', [LettersOutController::class, 'classerLetter'])->name('classerDepart');
        Route::resource('courriers-departs', LettersOutController::class);


        /*******************     ROUTE USERS     **************************************************************/
        Route::get('/utilisateurs/statut/{id}', [UsersController::class, 'status'])->name('statutUtulisateur');
        Route::get('/utilisateurs/motdepasseoublier/{id}', [UsersController::class, 'resetpassword'])->name('resetpasswordUtulisateur');
        Route::get('/utilisateurs/historiques', [UsersController::class, 'userHistories'])->name('historyUtulisateur');
        Route::resource('utilisateurs', UsersController::class);

    });



    /******************************* SERVICE COURRIER ROUTE   **********************************************/
    Route::prefix('agent')->group(function () {

        /******************   ROUTE HOME ****************************************************************/
        Route::get('/dashboard', [DashboardAgentCourrierController::class, 'index'])->name('courrierHomePage');

         /*********************   ROUTE CHRONO IN   *********************************************************/
        Route::resource('chrono-arrive', AgentCourrierChronoIn::class);

        /*********************   ROUTE CHRONO OUT   *********************************************************/
        Route::resource('chrono-depart', AgentCourrierChronoOut::class);

        /*********************   ROUTE LETTERS IN   *********************************************************/
        Route::get('/courriers/arrives/imputation/{id}', [AgentCourrierLetterIn::class, 'imputation'])->name('agentImputation');
        Route::post('/courriers/arrives/imputation/attribution', [AgentCourrierLetterIn::class, 'saveImputation'])->name('agentSaveImputation');
        Route::get('/courriers/arrives/imputation/modifier/{id}', [AgentCourrierLetterIn::class, 'editImputation'])->name('agentEditImputation');
        Route::put('/courriers/arrives/imputation/save/modifier/{id}', [AgentCourrierLetterIn::class, 'updateImputation'])->name('agentSaveEditImputation');
        Route::get('/courriers/arrives/imputation/decharger/{id}', [AgentCourrierLetterIn::class, 'editDechargeImputation'])->name('agentDechargeImputation');
        Route::put('/courriers/arrives/imputation/save/decharge/{id}', [AgentCourrierLetterIn::class, 'saveDechargeImputation'])->name('agentSaveDechargeImputation');
        Route::get('/courriers/arrives/classer/{id}', [AgentCourrierLetterIn::class, 'classerLetter'])->name('agentClasser');
        Route::resource('courrier-arrive', AgentCourrierLetterIn::class);

        /*********************   ROUTE LETTERS OUTS   *********************************************************/
        Route::get('/courrier-depart/classer/{id}', [AgentCourrierLetterOut::class, 'classerLetter'])->name('classerDepartAgent');
        Route::resource('courrier-depart', AgentCourrierLetterOut::class);

    });

});

