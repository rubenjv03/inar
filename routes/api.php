<?php

use App\Http\Controllers\GHController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/github')->group(
    function () {
        Route::get('/getRepositories', [GHController::class, 'get_repositories']);
        Route::get('/getCollaborators/{repo}', [GHController::class, 'get_collaborators_by_repo']);
        Route::post('/createRepo/{repoName}', [GHController::class, 'create_new_repo']);
        Route::patch('/makePrivate/{repo}', [GHController::class, 'make_repository_private']);
    }
);

Route::prefix('/f1')->group(
    function () {
        Route::get('/getDrivers', [FormulaController::class, 'get_all_drivers']);
        Route::get('/getTeams', [FormulaController::class, 'get_all_teams']);
        Route::get('/getResults/{season}/{race}', [FormulaController::class, 'get_results_by_season_and_race']);
        Route::get('/getLaptime/{season}/{race}/{driver}/{lap}', [FormulaController::class, 'get_laptime_by_season_race_and_driver']);
        Route::get('/getStandings/{season}', [FormulaController::class, 'get_standings_by_season']);
        Route::get('/getCircuit/{circuit}', [FormulaController::class, 'get_circuit_by_id']);
    }
);