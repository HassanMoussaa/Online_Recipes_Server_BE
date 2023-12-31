<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\MealCalendar;

class MealCalendarController extends Controller
{
    public function addPlannedMeal(Request $request)
    {
        $user = Auth::user();
        $recipeId = $request->input('recipe_id');
        $date = $request->input('date');


        $existingMeal = MealCalendar::where([
            'user_id' => $user->id,
            'recipe_id' => $recipeId,
            'date' => $date,
        ])->first();

        if ($existingMeal) {
            return response()->json(['message' => 'Meal is already planned for this date'], 400);
        }

        $plannedMeal = MealCalendar::updateOrCreate(
            ['user_id' => $user->id, 'recipe_id' => $recipeId, 'date' => $date],
            []
        );

        return response()->json(['message' => 'Planned meal added successfully']);
    }


    public function getPlannedMeals()
    {
        $user = Auth::user();
        $plannedMeals = MealCalendar::with('recipe')->where('user_id', $user->id)->get();

        return response()->json(['planned_meals' => $plannedMeals]);
    }


}