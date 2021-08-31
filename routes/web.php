<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
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
        $countEmployee = Employee::count();
        $countfamale = Employee::where('gender','famale')->count();
        $countmale = Employee::where('gender','male')->count();

        $countproducts = Products::count();

    // var_dump($countproducts);
    // exit;

    return view('welcome', compact('countEmployee', 'countfamale','countmale', 'countproducts'));
});

// Login user
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login_user', [LoginController::class, 'login_user'])->name('login_user');

// Regidter user
Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register_user', [LoginController::class, 'register_user'])->name('register_user');

// logout user
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// profile user
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/updata_user/{id}', [ProfileController::class, 'updata_user'])->name('updata_user');



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
Route::post('/updateproduct/{id}', [ProductsController::class, 'updateproduct'])->name('updateproduct');

// form add_quantity_products
Route::get('/add_quantity/{id}', [ProductsController::class, 'add_quantity'])->name('add_quantity');
Route::post('/add_quantity_products/{id}', [ProductsController::class, 'add_quantity_products'])->name('add_quantity_products');

// forme in delete data
Route::get('/delete/{id}', [ProductsController::class, 'delete'])->name('delete');

// export pdf
Route::get('/exportpdf_product', [ProductsController::class, 'exportpdf_product'])->name('exportpdf_product');

// export Excel
Route::get('/exportexcel_products', [ProductsController::class, 'exportexcel_products'])->name('exportexcel_products');

// export importexcel
Route::post('/importexcel_products', [ProductsController::class, 'importexcel_products'])->name('importexcel_products');
