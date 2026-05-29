<?php

use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\VehiculeController;
use App\Http\Controllers\Admin\CatActuController;
use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\Admin\EssaieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('front.home');
Route::get('/{typeSlug}/{id}', [VehiculeController::class, 'showFront'])
    ->name('front.vehicule.show')
    ->where('id', '[0-9]+');
Route::get('/api/front/vehicules/{id}', [VehiculeController::class, 'showAPI']);
Route::get('/categorie/{slug}', [CategorieController::class, 'showFront'])
    ->name('front.categorie.show')
    ->where('slug', '.*');  
Route::get('/api/categories/{slug}', [CategorieController::class, 'showAPI']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // TYPES
    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create'); 
    Route::post('/types', [TypeController::class, 'store'])->name('types.store');   
    Route::get('/types/{type}/edit', [TypeController::class, 'edit'])->name('types.edit');   
    Route::put('/types/{type}', [TypeController::class, 'update'])->name('types.update');  
    Route::get('/types/{type}/delete', [TypeController::class, 'confirmDelete'])->name('types.delete'); 
    Route::delete('/types/{type}/delete/execute', [TypeController::class, 'delete'])->name('types.delete-execute');  

    //CATEGORIES
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}/delete', [CategorieController::class, 'confirmDelete'])->name('categories.delete');
    Route::delete('/categories/{id}/delete/execute', [CategorieController::class, 'delete'])->name('categories.delete-execute');

    //VEHICULES
    Route::get('/vehicules', [VehiculeController::class, 'index'])->name('vehicules.index');
    Route::get('/vehicules/create', [VehiculeController::class, 'create'])->name('vehicules.create');
    Route::post('/vehicules', [VehiculeController::class, 'store'])->name('vehicules.store');
    Route::get('/vehicules/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
    Route::put('/vehicules/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');
    Route::get('/vehicules/{id}/delete', [VehiculeController::class, 'confirmDelete'])->name('vehicules.delete');
    Route::delete('/vehicules/{id}/delete/execute', [VehiculeController::class, 'delete'])->name('vehicules.delete-execute');

    //CATACTUS
    Route::get('/catactus', [CatActuController::class, 'index'])->name('catactus.index');
    Route::get('/catactus/create', [CatActuController::class, 'create'])->name('catactus.create');
    Route::post('/catactus', [CatActuController::class, 'store'])->name('catactus.store');
    Route::get('/catactus/{id}/edit', [CatActuController::class, 'edit'])->name('catactus.edit');
    Route::put('/catactus/{id}', [CatActuController::class, 'update'])->name('catactus.update');
    Route::get('/catactus/{id}/delete', [CatActuController::class, 'confirmDelete'])->name('catactus.delete');
    Route::delete('/catactus/{id}/delete/execute', [CatActuController::class, 'delete'])->name('catactus.delete-execute');

    //ACTUS
    Route::get('/actus', [ActualiteController::class, 'index'])->name('actus.index');
    Route::get('/actus/create', [ActualiteController::class, 'create'])->name('actus.create');
    Route::post('/actus', [ActualiteController::class, 'store'])->name('actus.store');
    Route::get('/actus/{id}/edit', [ActualiteController::class, 'edit'])->name('actus.edit');
    Route::put('/actus/{id}', [ActualiteController::class, 'update'])->name('actus.update');
    Route::get('/actus/{id}/delete', [ActualiteController::class, 'delete'])->name('actus.delete');
    Route::delete('/actus/{id}', [ActualiteController::class, 'destroy'])->name('actus.destroy');

    //ESSAIS
    Route::get('/essais', [EssaieController::class, 'index'])->name('essaies.index');
    Route::get('/essais/create', [EssaieController::class, 'create'])->name('essaies.create');
    Route::post('/essais', [EssaieController::class, 'store'])->name('essaies.store');
    Route::get('/essais/{id}/edit', [EssaieController::class, 'edit'])->name('essaies.edit');
    Route::put('/essais/{id}', [EssaieController::class, 'update'])->name('essaies.update');
    Route::get('/essais/{id}/delete', [EssaieController::class, 'delete'])->name('essaies.delete');
    Route::delete('/essais/{id}', [EssaieController::class, 'destroy'])->name('essaies.destroy');

});

require __DIR__.'/auth.php';
