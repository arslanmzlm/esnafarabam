<?php

use App\Http\Controllers\Admin\AttributeCategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\NeighborhoodController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProvinceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleTypeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('users', [UserController::class, 'list'])->name('user.list');
        Route::get('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('user/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('user/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::post('user/delete/{user}', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('users/pending', [UserController::class, 'listPending'])->name('user.pending.list');
        Route::post('user/approve/{user}', [UserController::class, 'approve'])->name('user.approve');

        Route::get('provinces', [ProvinceController::class, 'list'])->name('province.list');
        Route::get('province/create', [ProvinceController::class, 'create'])->name('province.create');
        Route::post('province/store', [ProvinceController::class, 'store'])->name('province.store');
        Route::get('province/edit/{province}', [ProvinceController::class, 'edit'])->name('province.edit');
        Route::post('province/update/{province}', [ProvinceController::class, 'update'])->name('province.update');
        Route::post('province/delete/{province}', [ProvinceController::class, 'destroy'])->name('province.destroy');

        Route::get('districts', [DistrictController::class, 'list'])->name('district.list');
        Route::get('district/create', [DistrictController::class, 'create'])->name('district.create');
        Route::post('district/store', [DistrictController::class, 'store'])->name('district.store');
        Route::get('district/edit/{district}', [DistrictController::class, 'edit'])->name('district.edit');
        Route::post('district/update/{district}', [DistrictController::class, 'update'])->name('district.update');
        Route::post('district/delete/{district}', [DistrictController::class, 'destroy'])->name('district.destroy');

        Route::get('neighborhoods', [NeighborhoodController::class, 'list'])->name('neighborhood.list');
        Route::get('neighborhood/create', [NeighborhoodController::class, 'create'])->name('neighborhood.create');
        Route::post('neighborhood/store', [NeighborhoodController::class, 'store'])->name('neighborhood.store');
        Route::get('neighborhood/edit/{neighborhood}', [NeighborhoodController::class, 'edit'])->name('neighborhood.edit');
        Route::post('neighborhood/update/{neighborhood}', [NeighborhoodController::class, 'update'])->name('neighborhood.update');
        Route::post('neighborhood/delete/{neighborhood}', [NeighborhoodController::class, 'destroy'])->name('neighborhood.destroy');

        Route::get('brands', [BrandController::class, 'list'])->name('brand.list');
        Route::get('brand/create', [BrandController::class, 'create'])->name('brand.create');
        Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
        Route::get('brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('brand/update/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::post('brand/delete/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');

        Route::get('attribute/categories', [AttributeCategoryController::class, 'list'])->name('attribute.category.list');
        Route::get('attribute/category/items/{attributeCategory}', [AttributeCategoryController::class, 'items'])->name('attribute.category.items');
        Route::get('attribute/category/create', [AttributeCategoryController::class, 'create'])->name('attribute.category.create');
        Route::post('attribute/category/store', [AttributeCategoryController::class, 'store'])->name('attribute.category.store');
        Route::get('attribute/category/edit/{attributeCategory}', [AttributeCategoryController::class, 'edit'])->name('attribute.category.edit');
        Route::post('attribute/category/update/{attributeCategory}', [AttributeCategoryController::class, 'update'])->name('attribute.category.update');
        Route::post('attribute/category/delete/{attributeCategory}', [AttributeCategoryController::class, 'destroy'])->name('attribute.category.destroy');

        Route::get('attributes', [AttributeController::class, 'list'])->name('attribute.list');
        Route::get('attribute/create', [AttributeController::class, 'create'])->name('attribute.create');
        Route::post('attribute/store', [AttributeController::class, 'store'])->name('attribute.store');
        Route::get('attribute/edit/{attribute}', [AttributeController::class, 'edit'])->name('attribute.edit');
        Route::post('attribute/update/{attribute}', [AttributeController::class, 'update'])->name('attribute.update');
        Route::post('attribute/delete/{attribute}', [AttributeController::class, 'destroy'])->name('attribute.destroy');

        Route::get('vehicle/types', [VehicleTypeController::class, 'list'])->name('vehicle.type.list');
        Route::get('vehicle/type/create', [VehicleTypeController::class, 'create'])->name('vehicle.type.create');
        Route::post('vehicle/type/store', [VehicleTypeController::class, 'store'])->name('vehicle.type.store');
        Route::get('vehicle/type/edit/{vehicleType}', [VehicleTypeController::class, 'edit'])->name('vehicle.type.edit');
        Route::post('vehicle/type/update/{vehicleType}', [VehicleTypeController::class, 'update'])->name('vehicle.type.update');
        Route::post('vehicle/type/delete/{vehicleType}', [VehicleTypeController::class, 'destroy'])->name('vehicle.type.destroy');

        Route::get('vehicles', [VehicleController::class, 'list'])->name('vehicle.list');
        Route::get('vehicle/create', [VehicleController::class, 'create'])->name('vehicle.create');
        Route::post('vehicle/store', [VehicleController::class, 'store'])->name('vehicle.store');
        Route::get('vehicle/edit/{vehicle}', [VehicleController::class, 'edit'])->name('vehicle.edit');
        Route::post('vehicle/update/{vehicle}', [VehicleController::class, 'update'])->name('vehicle.update');
        Route::post('vehicle/delete/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicle.destroy');
        Route::get('vehicle/select', [VehicleController::class, 'select'])->name('vehicle.select');

        Route::get('items', [ItemController::class, 'list'])->name('item.list');
        Route::get('items/grid', [ItemController::class, 'grid'])->name('item.grid');
        Route::get('item/{item}', [ItemController::class, 'show'])->name('item.show');
        Route::get('item/create/{vehicle}', [ItemController::class, 'create'])->name('item.create');
        Route::post('item/store', [ItemController::class, 'store'])->name('item.store');
        Route::get('item/edit/{item}', [ItemController::class, 'edit'])->name('item.edit');
        Route::post('item/update/{item}', [ItemController::class, 'update'])->name('item.update');
        Route::get('item/control/{item}', [ItemController::class, 'control'])->name('item.control');
        Route::post('item/evaluate/{item}', [ItemController::class, 'evaluate'])->name('item.evaluate');
        Route::post('item/delete/{item}', [ItemController::class, 'destroy'])->name('item.destroy');

        Route::get('pages', [PageController::class, 'list'])->name('page.list');
        Route::get('page/create', [PageController::class, 'create'])->name('page.create');
        Route::post('page/store', [PageController::class, 'store'])->name('page.store');
        Route::get('page/edit/{page}', [PageController::class, 'edit'])->name('page.edit');
        Route::post('page/update/{page}', [PageController::class, 'update'])->name('page.update');
        Route::post('page/delete/{page}', [PageController::class, 'destroy'])->name('page.destroy');

        Route::get('banners', [BannerController::class, 'list'])->name('banner.list');
        Route::get('banner/create', [BannerController::class, 'create'])->name('banner.create');
        Route::post('banner/store', [BannerController::class, 'store'])->name('banner.store');
        Route::get('banner/edit/{banner}', [BannerController::class, 'edit'])->name('banner.edit');
        Route::post('banner/update/{banner}', [BannerController::class, 'update'])->name('banner.update');
        Route::post('banner/delete/{banner}', [BannerController::class, 'destroy'])->name('banner.destroy');
    });
