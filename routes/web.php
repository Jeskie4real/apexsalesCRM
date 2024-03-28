<?php

use App\Http\Controllers\InvoiceReportController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\QuotationReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ContactController;

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

Route::get('/', function () {
    return redirect('/admin/login');
});
Route::resource('task', TasksController::class);
Route::resource('contact', ContactController::class);

Route::get('/login', function () {
    return redirect('/admin/login');
});


Route::middleware('signed')
    ->get('quotation/{quote}/pdf', QuotationReportController::class)
    ->name('quotation.pdf');

Route::middleware('signed')
    ->get('invoice/{invoice}/pdf', InvoiceReportController::class)
    ->name('invoice.pdf');
