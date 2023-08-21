<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingListItem extends Model
{
    protected $fillable = ['shopping_list_id', 'recipe_id'];

    // Placeholder relationships: Add actual relationships later in controllers and APIs
    public function shoppingList()
    {
        // Placeholder relationship for shopping list this item belongs to
    }

    public function recipe()
    {
        // Placeholder relationship for recipe associated with this shopping list item
    }

    // Add other placeholder relationships as needed
}