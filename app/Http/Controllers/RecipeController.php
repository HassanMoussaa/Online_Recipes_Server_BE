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
        try {
            $validatedData = $request->validate([
                'name' => 'required|string',
                'cuisine' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'ingredients' => 'required|array',
                'ingredients.*' => 'required|string',
            ]);

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

            $recipeID = $recipe->id; // Get the ID of the newly created recipe

            // Create ingredients separately and associate them with the recipe
            foreach ($validatedData['ingredients'] as $ingredientName) {
                $ingredient = Ingredient::create([
                    'name' => $ingredientName,
                    'recipe_id' => $recipeID,
                ]);
            }
            DB::commit();

            return response()->json(['message' => 'Recipe created successfully', 'recipe' => $recipe], 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Error creating recipe', 'error' => $e->getMessage()], 500);
        }
    }


    public function getUserRecipes()
    {
        $user = Auth::user();

        $userRecipes = $user->recipes()->with('ingredients')->get();

        return response()->json(['recipes' => $userRecipes]);
    }

    public function getAllRecipesExceptUser()
    {
        $user = Auth::user();

        $recipes = Recipe::where('user_id', '!=', $user->id)->with('ingredients')->get();

        return response()->json(['recipes' => $recipes]);
    }



    public function searchRecipes(Request $request)
    {
        $query = $request->input('query');

        $recipes = Recipe::where(function ($recipeQuery) use ($query) {
            $recipeQuery->where('name', 'like', "%$query%")
                ->orWhere('cuisine', 'like', "%$query%")
                ->orWhereHas('ingredients', function ($ingredientQuery) use ($query) {
                    $ingredientQuery->where('name', 'like', "%$query%");
                });
        })
            ->with('ingredients')
            ->get();

        return response()->json(['recipes' => $recipes]);
    }






    public function likeRecipe(Recipe $recipe)
    {
        $user = Auth::user();

        if (!$user->likes->contains($recipe)) {
            $user->likes()->attach($recipe);
            return response()->json(['message' => 'Recipe liked successfully']);
        }

        return response()->json(['message' => 'Recipe already liked'], 400);
    }

    public function unlikeRecipe(Recipe $recipe)
    {
        $user = Auth::user();

        if ($user->likes->contains($recipe)) {
            $user->likes()->detach($recipe);
            return response()->json(['message' => 'Recipe like removed successfully']);
        }

        return response()->json(['message' => 'Recipe not liked'], 400);
    }



    public function checkRecipeLiked(Recipe $recipe)
    {
        $user = Auth::user();

        $isLiked = $user->likes->contains($recipe);

        return response()->json(['liked' => $isLiked]);
    }

    public function addComment(Recipe $recipe, Request $request)
    {
        $user = Auth::user();

        $commentText = $request->input('comment');

        $comment = $recipe->comments()->create([
            'user_id' => $user->id,
            'comment_text' => $commentText,
        ]);

        return response()->json(['message' => 'Comment added successfully', 'comment' => $comment]);
    }

    public function getComments(Recipe $recipe)
    {
        $comments = $recipe->comments()->with('user')->get();

        return response()->json(['comments' => $comments]);
    }







}