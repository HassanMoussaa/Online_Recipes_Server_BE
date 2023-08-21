<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingListItem;

class ShoppingListController extends Controller
{




    public function addToShoppingList(Request $request)
    {
        $user = Auth::user();
        $recipeId = $request->input('recipe_id');


        $shoppingListItem = ShoppingListItem::create([
            'user_id' => $user->id,
            'recipe_id' => $recipeId,
        ]);

        return response()->json(['message' => 'Recipe added to shopping list']);
    }
    public function getShoppingListRecipes()
    {
        $user = Auth::user();
        $recipes = $user->shoppingListItems->pluck('recipe');

        return response()->json(['recipes' => $recipes]);
    }


}