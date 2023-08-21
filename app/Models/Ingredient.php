<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['recipe_id', 'name'];




    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}