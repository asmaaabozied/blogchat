<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupUserTable extends Migration
{
    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('group_id')->constrained('groups');
            $table->foreignId('user_id')->constrained('users');

            $table->unique(['group_id', 'user_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('group_user');
    }
}
