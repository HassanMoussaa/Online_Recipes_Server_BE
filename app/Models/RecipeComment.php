<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'recipe_id', 'comment_text'];

    // Placeholder relationships: Add actual relationships later in controllers and APIs
    public function user()
    {
        // Placeholder relationship for user who commented
    }

    public function recipe()
    {
        // Placeholder relationship for commented recipe
    }

    // Add other placeholder relationships as needed
}