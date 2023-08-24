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
            $table->foreignId('user_id')->constrained(); 
            $table->date('date');
            $table->foreignId('recipe_id')->constrained(); 
         
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('meal_calendar');
    }
}