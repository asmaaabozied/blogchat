<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowerUserTable extends Migration
{
    public function up()
    {
        Schema::create('follower_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('follower_id')->constrained('users');
            $table->primary(['user_id', 'follower_id']);
            $table->boolean('is_accepted')->nullable()->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('follower_user');
    }
}
