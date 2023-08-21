<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\ShoppingList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ShoppingListItem;

class ShoppingListController extends Controller
{




    public function addToShoppingList(Request $request)
    {
        $user = Auth::user();
        $recipeId = $request->input('recipe_id');

        $shoppingListId = ShoppingList::where('user_id', $user->id)->value('id');

        if (!$shoppingListId) {
            return response()->json(['message' => 'Shopping list not found'], 404);
        }


        $existingItem = ShoppingListItem::where('shopping_list_id', $shoppingListId)
            ->where('recipe_id', $recipeId)
            ->first();

        if ($existingItem) {
            return response()->json(['message' => 'Recipe is already in the shopping list'], 200);
        }

        $shoppingListItem = ShoppingListItem::create([
            'shopping_list_id' => $shoppingListId,
            'recipe_id' => $recipeId,
        ]);

        return response()->json(['message' => 'Recipe added to shopping list']);
    }


    public function getShoppingListRecipes()
    {
        $user = Auth::user();


        $shoppingListId = ShoppingList::where('user_id', $user->id)->value('id');

        if (!$shoppingListId) {

            return response()->json(['message' => 'Shopping list not found'], 404);
        }


        $recipeIds = ShoppingListItem::where('shopping_list_id', $shoppingListId)
            ->pluck('recipe_id')
            ->toArray();


        $recipes = Recipe::whereIn('id', $recipeIds)->get();

        return response()->json(['recipes' => $recipes]);
    }


}