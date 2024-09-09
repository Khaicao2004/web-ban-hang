<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\WareHouseController;
use App\Models\Catalogue;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')
->as('admin.')
->group(function () {
    Route::get('/', function (){
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('catalogues', CatalogueController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('values', AttributeValueController::class);
    Route::resource('products', ProductController::class);
    Route::resource('tags', TagController::class);
    Route::resource('wareHouses', WareHouseController::class);
    Route::resource('inventories', InventoryController::class);
});
