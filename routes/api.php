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
Route::group(["namespace" => "App\Http\Controllers\Api\V1_0", "prefix" => "/v1.0", "as" => "api.v1_0."], static function () {
    #/api/v1.0/exampleEntities
    Route::group([
        "namespace" => "ExampleEntity",
        "prefix" => "/exampleEntities",
        "as" => "example_entities.",
    ], static function () {
        Route::get("/validations/{method?}", "ExampleEntityCRUDController@getValidations")->name("validations");

        Route::get("/", "ExampleEntityCRUDController@index")->name("index");
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
