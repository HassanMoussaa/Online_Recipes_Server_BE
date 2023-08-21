<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['user_id', 'name', 'cuisine', 'image_url'];

    public function user()
    {

    }


}