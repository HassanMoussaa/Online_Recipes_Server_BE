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
        return $this->belongsTo(Recipe::class);
    }

    // Add other placeholder relationships as needed
}