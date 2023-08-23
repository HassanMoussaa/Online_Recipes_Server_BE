<?php

use App\Http\Controllers\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\MealCalendarController;


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
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


Route::middleware('auth:api')->group(function () {
    Route::post('/recipes/create', [RecipeController::class, 'create']);
    Route::get('/recipes', [RecipeController::class, 'getAllRecipesExceptUser']);
    Route::get('/recipes/user', [RecipeController::class, 'getUserRecipes']);

    Route::get('/recipes/search', [RecipeController::class, 'searchRecipes']);

    Route::post('/recipes/{recipe}/like', [RecipeController::class, 'likeRecipe']);
    Route::post('/recipes/{recipe}/unlike', [RecipeController::class, 'unlikeRecipe']);
    Route::get('/recipes/{recipe}/liked', [RecipeController::class, 'checkRecipeLiked']);

    Route::post('/recipes/{recipe}/comments', [RecipeController::class, 'addComment']);
    Route::get('/recipes/{recipe}/comments', [RecipeController::class, 'getComments']);



    Route::post('/shopping-list/add', [ShoppingListController::class, 'addToShoppingList']);
    Route::get('/shopping-list/recipes', [ShoppingListController::class, 'getShoppingListRecipes']);

    Route::post('/meal-calendar/add', [MealCalendarController::class, 'addPlannedMeal']);
    Route::get('/meal-calendar/planned-meals', [MealCalendarController::class, 'getPlannedMeals']);


});