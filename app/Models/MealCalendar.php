<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealCalendar extends Model
{
    protected $fillable = ['user_id', 'date', 'recipe_id'];

    // Placeholder relationships: Add actual relationships later in controllers and APIs
    public function user()
    {
        // Placeholder relationship for user who owns the meal calendar event
    }

    public function recipe()
    {
        // Placeholder relationship for recipe associated with this meal calendar event
    }

    // Add other placeholder relationships as needed
}