<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductsController;
use App\Models\Employee;
use App\Models\Products;
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

// Show table data
Route::get('/datapage', [EmployeeController::class, 'index'])->name('datapage');

// forme in insert data
Route::get('/plusdata', [EmployeeController::class, 'plusdata'])->name('plusdata');
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');

// forme in Update data
Route::get('/editdata/{id}', [EmployeeController::class, 'editdata'])->name('editdata');
Route::post('/update/{id}', [EmployeeController::class, 'update'])->name('update');

// forme in delete data
Route::get('/deleteemp/{id}', [EmployeeController::class, 'deleteemp'])->name('deleteemp');

// export pdf
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');

// export Excel
Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');

// export importexcel
Route::post('/importexcel', [EmployeeController::class, 'importexcel'])->name('importexcel');


// ================================== test products ================================================
Route::get('/productsdata', [ProductsController::class, 'index'])->name('productsdata');
// forme in insert data
Route::get('/plusproduct', [ProductsController::class, 'plusproduct'])->name('plusproduct');
Route::post('/inserproduct', [ProductsController::class, 'inserproduct'])->name('inserproduct');
// forme in Update data
Route::get('/editproduct/{id}', [ProductsController::class, 'editproduct'])->name('editproduct');
Route::get('/addproduct/{id}', [ProductsController::class, 'addproduct'])->name('addproduct');
Route::post('/uaddproduct/{id}', [ProductsController::class, 'uaddproduct'])->name('uaddproduct');
Route::post('/updateproduct/{id}', [ProductsController::class, 'updateproduct'])->name('updateproduct');
// forme in delete data
Route::get('/delete/{id}', [ProductsController::class, 'delete'])->name('delete');
// export pdf
Route::get('/exportpdf_product', [ProductsController::class, 'exportpdf_product'])->name('exportpdf_product');
// export Excel
Route::get('/exportexcel_products', [ProductsController::class, 'exportexcel_products'])->name('exportexcel_products');
// export importexcel
Route::post('/importexcel_products', [ProductsController::class, 'importexcel_products'])->name('importexcel_products');
