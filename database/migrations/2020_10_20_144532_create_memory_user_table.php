<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemoryUserTable extends Migration
{
    public function up()
    {
        Schema::create('memory_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->unsignedBigInteger('post_id');
            $table->primary(['post_id', 'user_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('memory_user');
    }
}
