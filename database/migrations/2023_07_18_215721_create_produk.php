<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduk extends Migration{
    public function up(){
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('price');
            $table->text('detail');
            $table->text('pictures');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('products');
    }
}
