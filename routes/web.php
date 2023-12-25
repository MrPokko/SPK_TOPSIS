<?php

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


use App\Http\Controllers\AlternatifController;

Route::resource('alternatif', AlternatifController::class);

// routes/web.php

use App\Http\Controllers\KriteriaController;

Route::resource('kriteria', KriteriaController::class);


// routes/web.php

use App\Http\Controllers\NilaiController;

Route::resource('nilai', NilaiController::class);


// routes/web.php

use App\Http\Controllers\TopsisController;

Route::get('topsis', [TopsisController::class, 'index'])->name('topsis.index');
Route::get('topsis-view', [TopsisController::class, 'view'])->name('topsis.view');
Route::get('/delete-all-items', [TopsisController::class, 'deleteAllItems'])->name('delete.all.items');
