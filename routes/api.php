<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

# /api/v1.0/
Route::group([
    "namespace" => "App\Http\Controllers\Api\V1_0",
    "prefix" => "/v1.0",
    "as" => "api.v1_0.",
], static function () {
    # /api/v1.0/auth
    Route::group([
        "namespace" => "Auth",
        "prefix" => "/auth",
    ], static function () {
        Route::post("/registration", "AuthController@registration")->name("registration");
        Route::post("/login", "AuthController@login")->name("login");
    });
});


# /api/v1.0/
Route::group([
    "namespace" => "App\Http\Controllers\Api\V1_0",
    "prefix" => "/v1.0",
    "as" => "api.v1_0.",
    "middleware" => ["auth:sanctum"],
], static function () {
    # /api/v1.0/auth
    Route::group([
        "namespace" => "Auth",
        "prefix" => "/auth",
    ], static function () {
        Route::post("/logout", "AuthController@logout")->name("logout");
        Route::get("/profile", "AuthController@profile")->name("profile");
    });

    #/api/v1.0/exampleEntities
    Route::group([
        "namespace" => "ExampleEntity",
        "prefix" => "/exampleEntities",
        "as" => "example_entities.",
    ], static function () {
        Route::post("/search", "ExampleEntityCRUDController@index")->name("search");
        Route::post("/setPosition", "ExampleEntityCRUDController@setPosition")->name("set-position");

        Route::post("/", "ExampleEntityCRUDController@store")->name("store");
        Route::delete("/", "ExampleEntityCRUDController@bulkDestroy")->name("bulk-destroy");

        #/api/v1.0/exampleEntities/:key
        Route::group([
            "prefix" => "/{key}",
        ], static function () {
            Route::get("/", "ExampleEntityCRUDController@show")->name("show");
            Route::put("/", "ExampleEntityCRUDController@update")->name("update");
            Route::delete("/", "ExampleEntityCRUDController@destroy")->name("destroy");
        });
    });
});
