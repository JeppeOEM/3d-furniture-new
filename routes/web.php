<?php

use App\Http\Controllers\VoxelController;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\SavedConfigurationsController;
use App\Http\Controllers\UserAccountController;
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

Route::get('frontpage', [IndexController::class, 'show'])->name('index.show');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::post('/delete-session', 'App\Http\Controllers\DeleteSessionController@delete')->name('deleteSession');
//alternative way 
// Route::get('/configurations/{configurationId}/components', 'App\Http\Controllers\ConfigurationController@componentsByConfiguration');
Route::get('/configuration/{configurationId}/components', [ConfigurationController::class, 'componentsByConfiguration'])->name('configuration.componentsByConfiguration');
Route::get('/configuration/session', [ConfigurationController::class, 'configurationBySession'])->name('configuration.configurationBySession');
Route::get('/configuration/componentlist', [ConfigurationController::class, 'getComponents'])->name('configuration.getComponents');
Route::get('/configuration/user', [ConfigurationController::class, 'configurationsByUser'])->name('configuration.configurationsByUser');
Route::get('/component', [ConfigurationController::class, 'componentById'])->name('configuration.componentById');

Route::get('/editor', [EditorController::class, 'index'])->name('editor');
Route::get('/editor/nomodal', [EditorController::class, 'nomodal'])->name('editor.nomodal');
Route::get('/editor/saved/{uniqueValue}', [EditorController::class, 'showId'])->name('editor.unique');
Route::post('/editor', [EditorController::class, 'store'])->name('editor.store');
Route::post('/editor/jsondump', [EditorController::class, 'store'])->name('jsonDump');
Route::get('/editor/show', [EditorController::class, 'show'])->name('editor.show');

Route::get('/planner', [PlannerController::class, 'index'])->name('planner');
Route::get('/planner/show', [PlannerController::class, 'show'])->name('planner.show');
Route::get('/planner/all', [PlannerController::class, 'all'])->name('planner.all');

Route::get('/list', [ListController::class, 'index'])->name('list');

Route::get('/saved', [SavedConfigurationsController::class, 'index'])->name('saved');

Route::post('configuration', [ConfigurationController::class, 'store'])->name('configuration.store');


Route::get('login', [AuthController::class, 'create'])
    ->name('login');
Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])
    ->name('logout');

Route::resource('user-account', UserAccountController::class)
    ->only(['create', 'store']);
