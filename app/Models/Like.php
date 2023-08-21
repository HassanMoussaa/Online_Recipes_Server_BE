<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'recipe_id'];

    // Placeholder relationships: Add actual relationships later in controllers and APIs
    public function user()
    {
        // Placeholder relationship for user who liked the recipe
    }

    public function recipe()
    {
        // Placeholder relationship for liked recipe
    }

    // Add other placeholder relationships as needed
}