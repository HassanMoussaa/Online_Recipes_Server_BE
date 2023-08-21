<?php




use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListItemsTable extends Migration
{
    public function up()
    {
        Schema::create('shopping_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shopping_list_id')->constrained();
            $table->foreignId('recipe_id')->constrained();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shopping_list_items');
    }
}