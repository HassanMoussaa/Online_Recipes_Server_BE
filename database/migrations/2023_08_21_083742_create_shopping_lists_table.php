<?php

// database/migrations/{timestamp}_create_shopping_lists_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListsTable extends Migration
{
    public function up()
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shopping_lists');
    }
}