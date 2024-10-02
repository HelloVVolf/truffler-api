<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaceCategoryController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TourCategoryController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TourTagController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return "aa";
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/users", [UserController::class, "index"]);

    Route::prefix('/auth')->group(function () {
        Route::get("/user", [AuthController::class, "user"]);
        Route::post("/logout", [AuthController::class, "logout"]);
    });
});


Route::prefix('/auth')->group(function () {
    Route::post("/register", [AuthController::class, "register"]);
    Route::post("/login", [AuthController::class, "login"]);
});


Route::post("/users", [UserController::class, "store"]);

Route::prefix('/region')->group(function () {
    Route::get("/", [CityController::class, "filterAll"]);
    Route::get("/search", [CityController::class, "search"]);

    Route::prefix('/cities')->group(function () {
        Route::get('/', [CityController::class, 'index']);
        Route::get('/{id}', [CityController::class, 'show']);
    });

    Route::prefix('/districts')->group(function () {
        Route::get('/', [DistrictController::class, 'index']);
        Route::get('/{id}', [DistrictController::class, 'show']);
    });
});

Route::get("/place_category", [PlaceCategoryController::class, "index"]);
Route::get("/place_category/{id}", [PlaceCategoryController::class, "show"]);

Route::prefix('/types')->group(function () {
    Route::get("/", [TypeController::class, "index"]);
    Route::get("/filter", [TypeController::class, "filter"]);
});

Route::prefix('/brands')->group(function () {
    Route::get("/", [BrandController::class, "index"]);
    Route::get("/filter", [BrandController::class, "filter"]);
});

Route::prefix('/rentals')->group(function () {
    Route::get("/", [RentalController::class, "index"]);
    Route::get("/edit/{slug?}", [RentalController::class, "edit"]);

    Route::get("/search", [RentalController::class, "search"]);
    Route::get("/{slug}", [RentalController::class, "showBySlug"]);

    Route::post("/paginator", [RentalController::class, "paginator"]);
    Route::post("/filter", [RentalController::class, "filter"]);

    Route::post("/", [RentalController::class, "store"]);
    Route::delete('/{slug}', [RentalController::class, 'delete']);
    Route::patch('/{slug}', [RentalController::class, 'update']);
});

// Route::group(['middleware' => ['cors']], function () {
// Your API routes here
Route::prefix('/places')->group(function () {
    Route::get("/", [PlaceController::class, "index"]);
    Route::get("/{slug}", [PlaceController::class, "show"]);

    Route::get("/edit/{slug}", [PlaceController::class, "edit"]);

    Route::post("/", [PlaceController::class, "store"]);
    Route::patch("/", [PlaceController::class, "update"]);
    Route::post("/filter", [PlaceController::class, "filter"]);
});;
// });

Route::prefix('/tour')->group(function () {
    Route::get("/show/{slug}", [TourController::class, "show"]);

    Route::get("/create", [TourController::class, "create"]);
    Route::post("/store", [TourController::class, "store"]);

    Route::get("/edit/{slug}", [TourController::class, "edit"]);
    Route::patch("/patch/{slug}", [TourController::class, "update"]);

    Route::delete("/delete/{slug}", [TourController::class, "destroy"]);

    Route::post("/filter", [TourController::class, "filter"]);
});

Route::prefix('/tour_category')->group(function () {
    Route::get("/", [TourCategoryController::class, "index"]);
});

Route::prefix('/tour_tag')->group(function () {
    Route::get("/", [TourTagController::class, "index"]);
});

Route::prefix('/order')->group(function () {
    Route::get("/", [OrderController::class, "index"]);
    Route::get("/details", [OrderController::class, "show"]);
    Route::post("/session", [OrderController::class, "session"]);
    Route::post("/", [OrderController::class, "store"]);
});

Route::prefix('/review')->group(function () {
    Route::get("/", [ReviewController::class, "index"]);
    Route::post("/", [ReviewController::class, "store"]);
});


Route::get('generate', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
});
Route::get("/q", [TestController::class, "test"]);
