<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipeCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('recipe_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('recipe_id')->constrained();
            $table->text('comment_text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recipe_comments');
    }
}