<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'cuisine' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ingredients' => 'required|array',
            'ingredients.*' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $image_url = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_path = Storage::putFile('recipe_images', $image);
                $image_url = Storage::url($image_path);
            }

            $recipe = Auth::user()->recipes()->create([
                'name' => $validatedData['name'],
                'cuisine' => $validatedData['cuisine'],
                'image_url' => $image_url,
            ]);

            foreach ($validatedData['ingredients'] as $ingredientName) {
                $ingredient = Ingredient::firstOrCreate(['name' => $ingredientName]);
                $recipe->ingredients()->attach($ingredient->id);
            }

            DB::commit();

            return response()->json(['message' => 'Recipe created successfully', 'recipe' => $recipe], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error creating recipe'], 500);
        }
    }


    public function getAllRecipesExceptUser()
    {
        $user = Auth::user();


        $recipes = Recipe::where('user_id', '!=', $user->id)->get();

        return response()->json(['recipes' => $recipes]);
    }


    public function getUserRecipes()
    {
        $user = Auth::user();


        $userRecipes = $user->recipes;

        return response()->json(['recipes' => $userRecipes]);
    }


}