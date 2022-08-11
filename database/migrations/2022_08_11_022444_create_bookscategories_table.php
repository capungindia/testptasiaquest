<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookscategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookscategories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bookid');
            $table->unsignedInteger('categoryid');
            $table->timestamps();

            $table->index('bookid');

            $table->foreign('bookid')
                ->references('id')->on('books')
                ->onDelete('cascade');

            $table->index('categoryid');

            $table->foreign('categoryid')
                ->references('id')->on('categories')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookscategories');
    }
}
