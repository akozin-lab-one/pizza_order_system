<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\user\UserController;

// middleware
Route::middleware(['admin_auth'])->group(function(){
    // redirect home view
    Route::redirect('', 'loginPage');

    // register view
    Route::get('/regiterPage', [AuthController::class, 'registerPage'])->name('Auth#register');

    // Login View
    Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('Auth#login');
});


Route::middleware(['auth'])->group(function () {
    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Admin account
    Route::middleware(['admin_auth'])->group(function(){
        // Admin Account
        Route::prefix('admin')->group(function () {
            // detail page
            Route::get('detail', [AdminController::class, 'detailPage'])->name('auth#detail');

            // edit account detail
            Route::get('editAccountDetail', [AdminController::class, 'editAccountPage'])->name('auth#edit');

            // update data
            Route::post('updateAccount/{id}', [AdminController::class, 'updateAccountData'])->name('auth#update');

            // change password page
            Route::get('changePassword', [AdminController::class, 'changePassword'])->name('auth#changepassword');

            // changepassword
            Route::post('passwordchange', [Admincontroller::class, 'passwordchange'])->name('auth#passwordchange');

            // adminlist
            Route::get('accountlist', [Admincontroller::class, 'accountList'])->name('auth#accountlist');
            Route::get('delete/{id}', [Admincontroller::class, 'accountDelete'])->name('auth#accountdelete');
            Route::get('account/role/{id}', [Admincontroller::class, 'accountRole'])->name('auth#accountrole');
            Route::post('change/{id}', [Admincontroller::class, 'ChangeRole'])->name('auth#change');

            //role change
            Route::get('role/change', [AdminController::class, 'RoleChange'])->name('admin#rolechange');
        });

        // Admin Category
        Route::prefix('category')->group(function(){
            // list
            Route::get('list', [CategoryController::class, 'listPage'])->name('Category#list');

            // createPage
            Route::get('createPage', [CategoryController::class, 'createPage'])->name('Category#createPage');

            // createData
            Route::post('create', [CategoryController::class, 'createData'])->name('Category#create');

            // delete data
            Route::get('delete/{id}', [CategoryController::class, 'deteteData'])->name('Category#delete');

            // editPage
            Route::get('editPage/{id}', [CategoryController::class, 'editDataPage'])->name('Category#editPage');

            // editData
            Route::post('update/{id}', [CategoryController::class, 'updatedata'])->name('Category#update');
        });

        //contact message
        Route::prefix('contact')->group(function(){
            Route::get('message/list', [ContactController::class, 'MessageList'])->name('admin#contact');

            Route::get('contact/detail/{id}', [ContactController::class, 'MessageDetail'])->name('admin#contactdetail');

            Route::get('delete/{id}', [ContactController::class, 'DeleteMessage'])->name('admin#deleteMessage');
        });

        // product list Page
        Route::prefix('product')->group(function(){
            // list page
            Route::get('list', [ProductController::class, 'productPage'])->name('product#list');

            // create pizza page
            Route::get('create', [ProductController::class, 'createPage'])->name('product#create');

            // create pizza
            Route::post('create', [ProductController::class, 'createData'])->name('product#createdata');

            // view pizza
            Route::get('view/{id}', [ProductController::class, 'viewPizza'])->name('product#view');

            // pizza edit page
            Route::get('editPizza/{id}', [ProductController::class, 'editDataPage'])->name('product#editpage');

            // pizza update data
            Route::post('update', [ProductController::class, 'updateData'])->name('product#update');

            // delete pizza
            Route::get('delete/{id}', [ProductController::class, 'deleteProduct'])->name('product#delete');
        });

        Route::prefix('order')->group(function(){
            Route::get('list', [OrderController::class, 'orderList'])->name('admin#orderlist');

            Route::get('status/list', [OrderController::class, 'OrderStatus'])->name('admin#status');

            Route::get('detail/list/{ordercode}', [OrderController::class, 'OrderDetailList'])->name('admin#orderdetail');

            Route::prefix('ajax')->group(function(){

                Route::get('status/change', [OrderController::class, 'OrderStatusChange'])->name('admin#statuschange');
            });
        });

        Route::prefix('user')->group(function(){
            Route::get('list', [UserController::class, 'list'])->name('admin#userlist');
            Route::get('detail/{id}', [UserController::class, 'Detail'])->name('admin#userdetail');
            Route::get('change/role', [UserController::class, 'ChangeRole'])->name('admin#userchnagerole');
            Route::get('delete/{id}', [UserController::class, 'DeleteUser'])->name('admin#deleteUser');
            Route::get('change/gender', [UserController::class, 'ChangeGender'])->name('admin#changegender');
        });

    });

    // user
    // home
    Route::group(['prefix'=>'user', 'middleware'=> 'user_auth'], function(){
        Route::get('/home', [UserController::class, 'userHomePage'])->name('user#home');

        Route::prefix('account')->group(function(){
            // detail Page
            Route::get('detail', [UserController::class, 'detailPage'])->name('user#detail');
            Route::get('filter/{id}', [UserController::class, 'filterPage'])->name('user#filter');

            Route::get('pizzadetail/{id}', [UserController::class, 'pizzaDetailPage'])->name('user#productdetail');

            //cart list
            Route::get('cartlist', [UserController::class, 'pizzaCartList'])->name('user#CartList');

            // History list
            Route::get('orderHistory', [UserController::class, 'History'])->name('user#OrderHistory');

            //contact list
            Route::get('contact/message', [UserController::class, 'ContactMessage'])->name('user#contact');

            //user account change
            Route::post('change/{id}', [UserController::class, 'userAccountChange'])->name('user#change');

            // password change Page
            Route::get('password', [UserController::class, 'passwordChangePage'])->name('user#passwordChangePage');

            // password change
            Route::post('change', [UserController::class, 'passwordChange'])->name('user#passwordChange');
        });

        Route::prefix('ajax')->group(function(){
            // ajax list
            Route::get('pizzaList', [AjaxController::class, 'AjaxList'])->name('user#pizzaList');

            Route::get('addTocart', [AjaxController::class, 'AddToCart'])->name('user#cart');

            // orderList
            Route::get('orderList', [AjaxController::class, 'OrderList'])->name('user#orderlist');

            // clear cart
            Route::get('clear/cart', [AjaxController::class, 'ClearCart'])->name('user#clearcart');

            //clear single cart list
            Route::get('clear/product/cart', [AjaxController::class, 'ClearProduct'])->name('user#clearproduct');

            //view count
            Route::get('view/count', [AjaxController::class, 'ViewCount'])->name('user#ajaxviewCount');

            //message contact
            Route::get('message/data', [AjaxController::class, 'ContactMe'])->name('user#ajaxmessage');
        });
    });
});
