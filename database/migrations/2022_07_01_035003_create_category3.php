<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategory3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Category_Name');
            $table->string('image')->nullable();
        });
        Schema::create('article', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('title_article');
            $table->longText('content_article');
            $table->timestamps();
            $table->foreignId('id_cat')->constrained('category')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category3');
    }
}
