<?php

use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\VehiculeController;
use App\Http\Controllers\Admin\CatActuController;
use App\Http\Controllers\Admin\ActualiteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // TYPES
    Route::get('/types', [TypeController::class, 'index'])->name('types.index');
    Route::get('/types/create', [TypeController::class, 'create'])->name('types.create'); 
    Route::post('/types', [TypeController::class, 'store'])->name('types.store');   
    Route::get('/types/{type}/edit', [TypeController::class, 'edit'])->name('types.edit');   
    Route::put('/types/{type}', [TypeController::class, 'update'])->name('types.update');  
    Route::get('/types/{type}/delete', [TypeController::class, 'delete'])->name('types.delete'); 
    Route::delete('/types/{type}', [TypeController::class, 'destroy'])->name('types.destroy');    

    //CATEGORIES
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieController::class, 'update'])->name('categories.update');
    Route::get('/categories/{categorie}/delete', [CategorieController::class, 'delete'])->name('categories.delete');
    Route::delete('/categories/{categorie}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    //VEHICULES
    Route::get('/vehicules', [VehiculeController::class, 'index'])->name('vehicules.index');
    Route::get('/vehicules/create', [VehiculeController::class, 'create'])->name('vehicules.create');
    Route::post('/vehicules', [VehiculeController::class, 'store'])->name('vehicules.store');
    Route::get('/vehicules/{id}/edit', [VehiculeController::class, 'edit'])->name('vehicules.edit');
    Route::put('/vehicules/{id}', [VehiculeController::class, 'update'])->name('vehicules.update');
    Route::get('/vehicules/{id}/delete', [VehiculeController::class, 'delete'])->name('vehicules.delete');
    Route::delete('/vehicules/{id}', [VehiculeController::class, 'destroy'])->name('vehicules.destroy');

    //CATACTUS
    Route::get('/catactus', [CatActuController::class, 'index'])->name('catactus.index');
    Route::get('/catactus/create', [CatActuController::class, 'create'])->name('catactus.create');
    Route::post('/catactus', [CatActuController::class, 'store'])->name('catactus.store');
    Route::get('/catactus/{id}/edit', [CatActuController::class, 'edit'])->name('catactus.edit');
    Route::put('/catactus/{id}', [CatActuController::class, 'update'])->name('catactus.update');
    Route::get('/catactus/{id}/delete', [CatActuController::class, 'delete'])->name('catactus.delete');
    Route::delete('/catactus/{id}', [CatActuController::class, 'destroy'])->name('catactus.destroy');

    //ACTUS
    Route::get('/actus', [ActualiteController::class, 'index'])->name('actus.index');
    Route::get('/actus/create', [ActualiteController::class, 'create'])->name('actus.create');
    Route::post('/actus', [ActualiteController::class, 'store'])->name('actus.store');
    Route::get('/actus/{id}/edit', [ActualiteController::class, 'edit'])->name('actus.edit');
    Route::put('/actus/{id}', [ActualiteController::class, 'update'])->name('actus.update');

});

require __DIR__.'/auth.php';
