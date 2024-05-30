<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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
Route::get('/clear-cache', function() {
    $allowed_ips = ['123.123.123.123']; // Ganti dengan IP yang diizinkan
    if (!in_array(request()->ip(), $allowed_ips)) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $exitCode = Artisan::call('cache:clear');
    $exitCodeConfig = Artisan::call('config:cache');
    $exitCodeView = Artisan::call('view:clear');
    $exitCodeRoute = Artisan::call('route:clear');
    
    return response()->json([
        'cache' => $exitCode == 0 ? 'Cache cleared successfully' : 'Cache clear failed',
        'config' => $exitCodeConfig == 0 ? 'Config cache cleared successfully' : 'Config cache clear failed',
        'view' => $exitCodeView == 0 ? 'View cache cleared successfully' : 'View cache clear failed',
        'route' => $exitCodeRoute == 0 ? 'Route cache cleared successfully' : 'Route cache clear failed',
    ]);
});

Route::get('/open-the-door', [AccessController::class, 'index'])->name('access');
Route::post('/open-the-door', [AccessController::class, 'unlock'])->name('access.unlock');

Route::middleware(['user.access'])->group(function () {
    Route::get('/', [PageController::class, 'index'])->name('home');
    Route::get('/search', function(){
        return redirect()->route('home');
    });
    Route::get('/search/{q}', [PageController::class, 'search'])->name('search');
    Route::get('/f/{slug}', [FolderController::class, 'show'])->name('folder.slug');
});

Route::group(['prefix' => 'kitchen'], function () {
    Voyager::routes();
});
