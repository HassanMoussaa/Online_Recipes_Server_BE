<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $fillable = ['user_id'];

    // Placeholder relationships: Add actual relationships later in controllers and APIs
    public function user()
    {
        // Placeholder relationship for user who owns the shopping list
    }

    // Add other placeholder relationships as needed
}