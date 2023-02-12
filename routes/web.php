<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlatController;

use Illuminate\Support\Facades\Route;
use App\Models\Plat;
use App\Models\User;
use App\Models\Categorie;


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
Route::middleware(['auth'])->group(function () {
    Route::get('/logout',[UserController::class,'logout'])->name('logout');
    Route::get('publisher/store', function (){
        return view('publisher.store',[
            'plats'=> Plat::with('categorie')->where('user_id',Auth::user()->id)->latest()->paginate(6),
            'count_plats' =>Plat::with('categorie')->where('user_id',Auth::user()->id)->count(),
            'categories' =>Categorie::all()
        ])->with('title','home');
     })->name('store');
     Route::resource('Plat', PlatController::class);

   
    
});
Route::get('/', function (){
    return view('pages.home',[
        'plats' => Plat::latest()->take(15)->get()
    ])->with('title','home');
 })->name("home");
Route::get('/admin', function (){
    return view('admin.dashboard')->with('title','dashboard');
 })->middleware('isAdmin');



Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('register',[UserController::class,'register_action'])->name('register.action');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('login',[UserController::class,'login_action'])->name('login.action');
Route::get('reset-pass/{token}',[UserController::class,'reset_pass'])->name('reset.password');
Route::post('reset-pass-action',[UserController::class,'reset_pass_action'])->name('reset.password.action');
Route::get('forget-pass',[UserController::class,'forget_pass'])->name('forget.password');
Route::post('forget-pass-action',[UserController::class,'forget_pass_action'])->name('forget.password.action');
Route::get('/change_pass',[UserController::class,'change_pass'])->name('change_pass');

