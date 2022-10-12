<?php


use App\Http\Controllers\Admin\CustomizeController;
use App\Http\Controllers\Admin\MenuBuilderController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\CategoryController;
use UniSharp\LaravelFilemanager\Lfm;


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    //Media Routes
    Route::get('/media', [PageController::class, 'media'])->name('media');
    // Category Routes
    Route::resource('/categories', CategoryController::class)->only(['index', 'store', 'edit', 'destroy']);
    Route::put('/categories/update', [CategoryController::class, 'update'])->name('categories.update');

    // Tag Routes
    Route::resource('/tags', TagController::class)->only(['index', 'store', 'edit', 'destroy']);
    Route::put('/tags/update', [TagController::class, 'update'])->name('tags.update');

    // Blog Routes
    Route::resource('/blogs', BlogController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Appearance customize Related Routes
    Route::get('/appearance/customize/{slug}', [CustomizeController::class, 'index'])->name('customize.index');
    Route::put('/appearance/customize/{option}', [CustomizeController::class, 'update'])->name('customize.update');

    // Appearance Menu Builder Related Routes
    Route::get('/appearance/menus', [MenuBuilderController::class, 'index'])->name('menus.index');
    Route::post('/appearance/menus', [MenuBuilderController::class, 'store'])->name('menus.store');

    // Settings Route List
    Route::get('/settings/{type}', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/{type}', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/sitemap/generate', [SettingsController::class, 'sitemap'])->name('settings.sitemap');

    // Account Related Routes
    Route::get('/account', [AccountController::class, 'account'])->name('account');
    Route::put('/account', [AccountController::class, 'updateAccount'])->name('account.update');
    Route::get('/account/change-password', [AccountController::class, 'changePassword'])->name('change.password');
    Route::put('/account/update-password', [AccountController::class, 'updatePassword'])->name('update.password');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
        Lfm::routes();
    });
});

Route::get('/admin/setup/all', function () {
    $admin = \App\Models\User::where('is_super', true)->first();
    if (!$admin) {
        \App\Models\User::create([
            'name' => 'Limon Rana',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@1122'),
            'is_super' => true
        ]);
        // Create Category
        \App\Models\Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
    return 'Setup All Data';
});
