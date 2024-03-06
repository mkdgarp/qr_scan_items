<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
Route::get('/', function () {
    return view('scan');
});
Route::post('/scan', function (Request $request) {
    $code = $request->input('code');

    // Query the database to get all posts related to the scanned code
    $data = DB::table('users')
        ->where('assets_key', $code)->get(); // Assuming 'code' is the column name

    // You can then do whatever you want with the $data data
    return response()->json(['data' => $data]);
});

Route::get('/list', function () {
    return view('list');
});

// Route::middleware(['auth'])->group(function () {
    Route::get('/form', function () {
        return view('form');
    });
// });
