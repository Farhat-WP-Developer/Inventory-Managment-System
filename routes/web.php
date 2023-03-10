<?php
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\SalesController;



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






//-----------------------------------------------------------------------------------------------------
// Login
// check the user login details with the database
Route::get('/', [AdminController::class, 'index'])->name('admin.login');
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

// Route::get('updatepassword', [AdminController::class, 'updatepassword']);

//-----------------------------------------------------------------------------------------------------


// when the admin is login we will access all the follwoing routes
Route::group(['middleware' => 'adminauth'], function()
{
 //-----------------------------------------------------------------------------------------------------
    // Dashboard
   Route::get('admin/dashboard', [ProductsController::class, 'index'])->name('admin.dashboard');
   // Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

   // Route to handle the AJAX request

Route::post('/update-price', function(Request $request) {
  // Update the product's price in the total inventories table
  DB::table('total_inventories')
    ->where('id', $request->productId)
    ->update(['per_price' => $request->price]);

  // Return a response to indicate that the update was successful
  return redirect()->back();
});

Route::post('/update-incentive', function(Request $request) {
    // Update the product's price in the total inventories table
    DB::table('total_inventories')
      ->where('id', $request->productId)
      ->update(['per_incentive' => $request->price]);

    // Return a response to indicate that the update was successful
    return redirect()->back();
  });


 //-----------------------------------------------------------------------------------------------------
    // Sales and Sales man

    Route::get('admin/sales_man', [SalesController::class, 'index']);
    Route::post('/newSalesMan', [SalesController::class, 'store']);

    Route::get('admin/sales',[SalesController::class, 'salesShow'] )->name('admin/sales');
    Route::post('/storeSales',[SalesController::class, 'storeSales'])->name('admin/storeSales');




 //-----------------------------------------------------------------------------------------------------
      //new product
      Route::get('admin/new_product', [ProductsController::class, 'newProductShow'])->name('admin.newProductShow');
      Route::post('/newProduct', [ProductsController::class, 'newProduct'])->name('admin.adddNewProduct');

 //-----------------------------------------------------------------------------------------------------
    // Truck Load
   //  Route::get('admin/truck', function(){
   //      return view('admin/truck_load');
   //  });
    Route::get('/admin/truck', [TruckController::class, 'index']);
    Route::post('/store_truck', [TruckController::class, 'store_truck'])->name('admin.truck');

   Route::get('/admin/addProduct', [TruckController::class, 'addProductShow'])->name('admin.showProduct');
   Route::post('/addProduct', [TruckController::class, 'addProduct'])->name('admin.addProduct');

      // Route::get('admin/add_products', function()
      // {
      //    return view('admin/add_products');

      // });
 //-----------------------------------------------------------------------------------------------------
    //  Inventory
    Route::get('admin/add_record', function(){
        return view('admin/add_record');
    });
    Route::post('store_pro', [ProductsController::class, 'store_pro']);

    // Route::post('admin/add_record', [InventoryController::class, 'store'])->name('admin.add_record');

    // These routes use for incoming invetory management
    Route::get('admin/edit/{id}', [ProductsController::class, 'edit']);
    Route::post('update/{id}', [ProductsController::class, 'update']);

    // These routes use for outgoing invetory management
    Route::get('admin/out_inv/{id}', [ProductsController::class, 'outInventory']);
    Route::post('/outInventoryUpdate/{id}', [ProductsController::class, 'outInventoryUpdate']);

 //-----------------------------------------------------------------------------------------------------
    // Reports
    Route::get('admin/reports', function(){
        return view('admin/reports');
    })->name('admin.reports');

    Route::get('admin/reports/index', [ExpensesController::class, 'index'])->name('admin.reports.index');
    Route::get('admin/reports/weekly', [ExpensesController::class, 'weekly'])->name('admin.reports.weekly');
    Route::get('admin/reports/fifteenDays', [ExpensesController::class, 'fifteenDays'])->name('admin.reports.fifteenDays');
    Route::get('admin/reports/monthly', [ExpensesController::class, 'monthly'])->name('admin.reports.monthly');


    // Route::get('admin/add_expenses', [ExpensesController::class,])
    Route::post('/store', [ExpensesController::class, 'store']);
 //-----------------------------------------------------------------------------------------------------

  // logout the user (the session will be end)
  Route::get('admin/logout', function ()
  {
      session()->forget('ADMIN_LOGIN');
      session()->forget('ADMIN_ID');
      session()->flash('error', 'Logout successfully');
      return redirect('/');
  });

 //-----------------------------------------------------------------------------------------------------

});
