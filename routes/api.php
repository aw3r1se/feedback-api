<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClaimController;
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

Route::prefix('/auth')
    ->name('auth.')
    ->group(function () {
        Route::post('login', [AuthController::class, 'login'])
            ->name('login');
        Route::middleware('auth:api')
            ->group(function () {
                Route::get('me', [AuthController::class, 'me'])
                    ->name('me');
                Route::post('logout', [AuthController::class, 'logout'])
                    ->name('logout');
            });
    });

Route::middleware('auth:api')
    ->prefix('/claims')
    ->name('claim.')
    ->group(function () {
        Route::middleware('can:claim.index')
            ->get('/', [ClaimController::class, 'index'])
            ->name('index');
        Route::middleware('can:claim.list')
            ->get('/list', [ClaimController::class, 'list'])
            ->name('list');
        Route::middleware('can:claim.show')
            ->get('/{claim}', [ClaimController::class, 'show'])
            ->name('show');
        Route::middleware('can:claim.store')
            ->post('/', [ClaimController::class, 'store'])
            ->name('store');
        Route::middleware('can:claim.update')
            ->patch('/', [ClaimController::class, 'update'])
            ->name('update');
        Route::middleware('can:claim.destroy')
            ->delete('/', [ClaimController::class, 'destroy'])
            ->name('destroy');
    });
