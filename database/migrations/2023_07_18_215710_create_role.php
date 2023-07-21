<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRole extends Migration{
   
    public function up(){
      Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->foreignId('id_role');
        });  
    }

    public function down(){
        Schema::dropIfExists('roles');
    }
}
