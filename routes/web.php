<?php

use App\Http\Controllers\aboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\roomsController;
use App\Http\Controllers\userController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\featuresController;
use App\Http\Middleware\AdminOrOwnerMiddleware;
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




Route::middleware('adminOrOwner')->group(function(){
    Route::get('/Admin',[AdminController::class,'index'])->name('Admin.index');
    // Route::get('/Admin/get_room',[roomsController::class,'get_room'])->name('get.room');

    Route::get('/Admin/users',[userController::class,'users'])->name('users');
    Route::get('/Admin/add_p_user',[userController::class,'add_p_users'])->name('add.p_users');
    Route::put('/Admin/Realyadd_p_user',[userController::class,'Realyadd_p_users'])->name('realy.add.p_user');
    Route::get('/Admin/update/p_user{id}',[userController::class,'update_p_user'])->name('update.p_user');
    Route::put('/Admin/Realyupdate_p_user{id}',[userController::class,'Realyupdate_p_user'])->name('Realyupdate.p_user');
    Route::get('/Admin/delet_p_user{id}',[userController::class,'delete_p_user'])->name('delete.physical_user');



});

Route::middleware('owner')->group(function (){
    Route::get('/Admin/about',[AboutController::class,'about'])->name('admin.about');
    Route::get('/Admin/add_about',[AboutController::class,'add_about'])->name('admin.add_about');
    Route::put('/Admin/add_about/section',[AboutController::class,'realy_add_about'])->name('realy.add.about');
    Route::get('/Admin/update_about/{id}',[AboutController::class,'update_about'])->name('update.about');
    Route::put('/Admin/update_about_/{id}',[AboutController::class,'realy_update_about'])->name('realy.update.about');
    Route::delete('/Admin/delet_about_/{id}',[AboutController::class,'delet_about'])->name('delete.about');
    Route::get('/Admin/about',[AboutController::class,'about'])->name('admin.about');

    Route::get('/Admin/features',[featuresController::class,'features'])->name('admin.features');
    Route::get('/Admin/add_feature',[featuresController::class,'add_feature_view']);
    Route::put('/Admin/add_feature',[featuresController::class,'add_feature'])->name('realy.add.feature');
    Route::get('/Admin/features/{id}',[featuresController::class,'features_update_view'])->name('feature.update');
    Route::put('/Admin/update_features',[featuresController::class,'features_update'])->name('realy.update.feature');
    Route::delete('/Admin/features/delete',[featuresController::class,'feature_delete'])->name('feature.delete');


    Route::get('/Admin/rooms',[roomsController::class,'rooms'])->name('Admin.rooms');
    Route::delete('/Admin{id}',[roomsController::class,'delet_room'])->name('delete.room');
    Route::get('/Admin/update{id}',[roomsController::class,'update_room'])->name('update.room');
    Route::put('/Admin/update{id}/room',[roomsController::class,'realy_update_room'])->name('realy.update.room');
    Route::get('/Admin/add',[roomsController::class,'add'])->name('admin.add');
    Route::put('/Admin/add_profile',[roomsController::class,'realy_add_room'])->name('realy.add.room');

    Route::get('/Admin/slider',[SliderController::class,'slider'])->name('slider');
    Route::post('/Admin/slider/add',[SliderController::class,'addSlider'])->name('add.slider');
    Route::post('/Admin/slider/update{id}',[SliderController::class,'updateSlider'])->name('update.slider');
    Route::put('/Admin/slider/realy_update{id}',[SliderController::class,'realy_updateSlider'])->name('realy.update.slide');
    Route::delete('/Admin/slider/delet{id}',[SliderController::class,'deleteSlider'])->name('delete.slider');

    Route::get('/Admin/admins', [AdminController::class,'admin'])->name('admin');
    Route::get('/Admin/add_admin', [AdminController::class,'add_admin'])->name('add.admin');
    Route::put('/Admin/Realyadd_admin', [AdminController::class,'Realyadd_admin'])->name('realy.add.admin');
    Route::get('/Admin/update/admin{id}',[AdminController::class,'update_admin'])->name('update.admin');
    Route::put('/Admin/Realyupdate_admin{id}', [AdminController::class,'Realyupdate_admin'])->name('Realyupdate.admin');
    Route::delete('/Admin/delete_admin{id}', [AdminController::class,'delete_admin'])->name('delete.admin');


    Route::get('/Admin/add_user',[userController::class,'add_users'])->name('add.users');
    Route::put('/Admin/Realyadd_user',[userController::class,'Realyadd_users'])->name('realy.add.user');
    Route::get('/Admin/update/user{id}',[userController::class,'update_user'])->name('update.user');
    Route::put('/Admin/Realyupdate_user{id}',[userController::class,'Realyupdate_user'])->name('Realyupdate.user');
    Route::delete('/Admin/delet_user{id}',[userController::class,'delete_user'])->name('delete.user');



    Route::get('/Admin/web_user',[userController::class,'web_users'])->name('web_users');
    Route::get('/Admin/user/{id}/{type}',[userController::class,'user_profile'])->name('user_profile');
});
Route::middleware('admin')->group(function (){

    Route::get('/Admin/review',[ReviewController::class,'reviews'])->name('admin.review');
    Route::post('/Admin/add_review',[ReviewController::class,'add_review'])->name('admin.add_review');
    Route::put('/Admin/add_review/section',[ReviewController::class,'realy_add_review'])->name('realy.add.review');
    Route::get('/Admin/update_review/{id}',[ReviewController::class,'update_review'])->name('update.review');
    Route::put('/Admin/update_review_/{id}',[ReviewController::class,'realy_update_review'])->name('realy.update.review');
    Route::delete('/Admin/delet_review_/{id}',[ReviewController::class,'delet_review'])->name('delete.review');





    Route::get('/Admin/reservation',[ReservationController::class,'reservation'])->name('reservation');
    Route::get('/Admin/add_reservation',[ReservationController::class,'add_reservation'])->name('add.reservation');
    Route::put('/Admin/Realyadd_reservation',[ReservationController::class,'Realyadd_reservation'])->name('realy.add.reservation');
    Route::get('/Admin/update/reservation{id}',[ReservationController::class,'update_reservation'])->name('update.reservation');
    Route::put('/Admin/Realyupdate_reservation{id}',[ReservationController::class,'Realyupdate_reservation'])->name('Realyupdate.reservation');
    Route::delete('/Admin/delet_reservation{id}',[ReservationController::class,'delete_reservation'])->name('delete.reservation');
    Route::post('/Admin/check_out',[ReservationController::class,'check_out'])->name('check.out');
    Route::post('/Admin/check_in',[ReservationController::class,'check_in'])->name('check.in');

});















Route::middleware('auth')->group(function (){
    Route::get('/profile{id}', [userController::class,'show_profile'])->name('user.profile');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::delete('/user_delet_review', [ReviewController::class,'user_delete_review'])->name('user.delete.review');
    Route::put('/user_update_review',[ReviewController::class,'user_update_review'])->name('user.update.review');

    Route::put('/user_update_profile',[userController::class,'user_update_profile'])->name('update.user.profile');

    Route::post('/booking', [bookingController::class,'index'])->name('booking.view');
    Route::post('/booking/check', [bookingController::class,'check_booking'])->name('booking.check');
    Route::match(['post','get'],'/room/profile', [roomsController::class,'room_profile'])->name('room.profile');
    Route::post('/review', [ReviewController::class,'index'])->name('add.review');

});
Route::middleware('guest')->group(function(){
    Route::get('/login/view', [AuthController::class,'login_view'])->name('login.view');
    Route::post('/login', [AuthController::class,'login'])->name('login');
    Route::get('/register/view', [AuthController::class,'register_view'])->name('register.view');
    Route::post('/register', [AuthController::class,'register'])->name('register');
    Route::get('/verify/view', [AuthController::class,'email_verification_view'])->name('verify.email');
    Route::post('/verify', [AuthController::class,'email_verification'])->name('verify');
    Route::get('/reset/view', [AuthController::class,'reset_password']);
    Route::post('/reset/password', [AuthController::class,'reset'])->name('reset.password');
    Route::post('/put_token', [AuthController::class,'check_token'])->name('check.token');
    Route::post('/reset', [AuthController::class,'password_verification'])->name('reset.password.realy');
});


Route::match(['put','post'],'/get/rooms', [ReservationController::class,'get_room'])->name('get.room');


Route::get('/contact', [loginController::class,'index']);



///////////

Route::get('/amenities', function () {
    return view('amenities');
});
Route::get('/about', [aboutController::class,'about_view']);




Route::get('/', [userController::class,'index'])->name('index');

Route::match(['post','get'] ,'/rooms', [roomsController::class,'index'])->name('rooms');


