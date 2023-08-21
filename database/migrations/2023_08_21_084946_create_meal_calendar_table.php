<?php
// database/migrations/{timestamp}_create_meal_calendar_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealCalendarTable extends Migration
{
    public function up()
    {
        Schema::create('meal_calendar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Adding foreign key reference to Users table
            $table->date('date');
            $table->foreignId('recipe_id')->constrained(); // Adding foreign key reference to Recipes table
            // Add other meal calendar-related fields
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_calendar');
    }
}