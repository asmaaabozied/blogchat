<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('message');
            $table->enum('type', ['Group', 'Normal']);
            $table->foreignId('group_id')->nullable()->default(null)->constrained('groups');
            $table->foreignId('from_id')->nullable()->default(null)->constrained('users');
            $table->foreignId('to_id')->nullable()->default(null)->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
