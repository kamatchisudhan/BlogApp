<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('');
});

Route::get('/', [AuthController::class, 'showLogin'])->name('login.form');

Route::get('/view', [BlogController::class, 'index'])->name('Blogs.index');
Route::post('/comments', [CommentController::class, 'store']);
Route::get('/createblog', [BlogController::class, 'create'])->name('createblog.create');
Route::post('/createblog', [BlogController::class, 'store'])->name('createblog.store');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index'); // List blogs
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create'); // Create form
    Route::post('/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store'); // Store new blog
    Route::get('/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit'); // Edit form
    Route::put('/blogs/{id}', [AdminBlogController::class, 'update'])->name('admin.blogs.update'); // Update blog
    Route::delete('/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy'); // Delete blog
});


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');



Route::get('/orders/user/{userId}', [OrderController::class, 'getUserOrders']);
Route::post('/orders', [OrderController::class, 'placeOrder']);
Route::patch('/orders/{orderId}/status', [OrderController::class, 'updateOrderStatus']);



Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route::prefix('admin')->group(function () {

// Route::get('/register', [AdminUserController::class, 'register'])->name('register');
// Route::post('/register', [AdminUserController::class, 'store'])->name('register.store');

// Route::get('/login', [AdminUserController::class, 'login'])->name('login');
// Route::post('/login', [AdminUserController::class, 'authenticate'])->name('login.authenticate');

// Route::post('/logout', [AdminUserController::class, 'logout'])->name('logout');

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard')->middleware('auth');

// });



Route::get('/admin', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
         return view('admin.dashboard');
     })->name('admin.dashboard')->middleware('auth');

    

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});




