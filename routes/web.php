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

Route::get('/login', 'AuthManageController@viewLogin')->name('login');
Route::post('/verify_login', 'AuthManageController@verifyLogin');
Route::post('/first_account', 'UserManageController@firstAccount');

Route::group(['middleware' => ['auth', 'checkRole:admin,kasir']], function(){
	Route::get('/logout', 'AuthManageController@logoutProcess');
	Route::get('/dashboard', 'ViewManageController@viewDashboard');
	Route::get('/dashboard/chart/{filter}', 'ViewManageController@filterChartDashboard');
	Route::post('/market/update', 'ViewManageController@updateMarket');
	// ------------------------- Fitur Cari -------------------------
	Route::get('/search/{word}', 'SearchManageController@searchPage');
	// ------------------------- Profil -------------------------
	Route::get('/profile', 'ProfileManageController@viewProfile');
	Route::post('/profile/update/data', 'ProfileManageController@changeData');
	Route::post('/profile/update/password', 'ProfileManageController@changePassword');
	Route::post('/profile/update/picture', 'ProfileManageController@changePicture');
	// ------------------------- Kelola Akun -------------------------
	// > Akun
	Route::get('/account', 'UserManageController@viewAccount');
	Route::get('/account/new', 'UserManageController@viewNewAccount');
	Route::post('/account/create', 'UserManageController@createAccount');
	Route::get('/account/edit/{id}', 'UserManageController@editAccount');
	Route::post('/account/update', 'UserManageController@updateAccount');
	Route::get('/account/delete/{id}', 'UserManageController@deleteAccount');
	Route::get('/account/filter/{id}', 'UserManageController@filterTable');
	// > Akses
	Route::get('/access', 'AccessManageController@viewAccess');
	Route::get('/access/change/{user}/{access}', 'AccessManageController@changeAccess');
	Route::get('/access/check/{user}', 'AccessManageController@checkAccess');
	Route::get('/access/sidebar', 'AccessManageController@sidebarRefresh');
	// ------------------------- Kelola Barang -------------------------
	// > Barang
	Route::get('/product', 'ProductManageController@viewProduct');
	Route::get('/product/new', 'ProductManageController@viewNewProduct');
	Route::post('/product/create', 'ProductManageController@createProduct');
	Route::post('/product/import', 'ProductManageController@importProduct');
	Route::get('/product/export', 'ProductManageController@exportProduct')->name('export_barang');
	Route::get('/product/edit/{id}', 'ProductManageController@editProduct');
	Route::post('/product/update', 'ProductManageController@updateProduct');
	Route::get('/product/delete/{id}', 'ProductManageController@deleteProduct');
	Route::get('/product/filter/{id}', 'ProductManageController@filterTable')->name('sort_barang');
	Route::get('/product/cari', 'ProductManageController@search')->name('search_barang');
	// > Pasok
	Route::get('/supply/system/{id}', 'SupplyManageController@supplySystem');
	Route::get('/supply', 'SupplyManageController@viewSupply');
	Route::get('/supply/new', 'SupplyManageController@viewNewSupply');
	Route::get('/supply/check/{id}', 'SupplyManageController@checkSupplyCheck');
	Route::get('/supply/data/{id}', 'SupplyManageController@checkSupplyData');
	Route::post('/supply/create', 'SupplyManageController@createSupply');
	Route::post('/supply/import', 'SupplyManageController@importSupply');
	Route::get('/supply/statistics', 'SupplyManageController@statisticsSupply');
	Route::get('/supply/statistics/product/{id}', 'SupplyManageController@statisticsProduct');
	Route::get('/supply/statistics/users/{id}', 'SupplyManageController@statisticsUsers');
	Route::get('/supply/statistics/table/{id}', 'SupplyManageController@statisticsTable');
	Route::post('/supply/statistics/export', 'SupplyManageController@exportSupply');
	Route::post('/supply/new_product', 'SupplyManageController@newProduct')->name('newProduct');
	Route::get('/supply/detail_pasok/{id}', 'SupplyManageController@detail')->name('detail_pasok');
	Route::post('/supply/detail_pasok/edited/{id}', 'SupplyManageController@edited')->name('edited_supply');
	Route::get('/suppply/pasok_complete/{id}', 'SupplyManageController@pasok_complate')->name('pasok_complate');
	// ------------------------- Transaksi -------------------------
	Route::get('/transaction', 'TransactionManageController@viewTransaction');
	Route::get('/transaction/products/search', 'TransactionManageController@ProductSearch');
	Route::get('/transaction/product/{id}', 'TransactionManageController@transactionProduct');
	Route::get('/transaction/product/check/{id}', 'TransactionManageController@transactionProductCheck');
	Route::post('/transaction/process', 'TransactionManageController@transactionProcess');
	Route::get('/transaction/receipt/{id}', 'TransactionManageController@receiptTransaction');
	// ------------------------- Kelola Laporan -------------------------
	Route::get('/report/transaction', 'ReportManageController@reportTransaction');
	Route::post('/report/transaction/filter', 'ReportManageController@filterTransaction');
	Route::get('/report/transaction/chart/{id}', 'ReportManageController@chartTransaction');
	Route::post('/report/transaction/export', 'ReportManageController@exportTransaction');
	Route::get('/report/workers', 'ReportManageController@reportWorker');
	Route::get('/report/workers/filter/{id}', 'ReportManageController@filterWorker');
	Route::get('/report/workers/detail/{id}', 'ReportManageController@detailWorker');
	Route::post('/report/workers/export/{id}', 'ReportManageController@exportWorker');

	// > Supplier
	Route::get("/supplier","SuplierController@index")->name("supplier");
	Route::get("/supplier/new","SuplierController@create")->name("supplier.new");
	Route::get("/supplier/{id}/edit","SuplierController@edit");
	Route::get("/supplier/{id}/delete","SupplierController@destroy");
	Route::post("/supplier/store","SuplierController@store")->name("supplier.create");
	Route::post("/supplier/update","SuplierController@update")->name("supplier.update");

	// > Category
	Route::get("/category","CategoryController@index")->name("category");
	Route::get("/category/new","CategoryController@create")->name("category.new");
	Route::get("/category/edit/{id}","CategoryController@edit")->name('category.edit');
	Route::get("/category/{id}/delete","CategoryController@destroy")->name('deleteCategory');
	Route::post("/category/store","CategoryController@store")->name("category.create");
	Route::post("/category/edit/post/{id}","CategoryController@update")->name("category.update");
});

// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');