<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_media', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('media_file');
            $table->unsignedBigInteger('user_id');
            $table->string('chat_room_id'); // subjected for change
            $table->string("type");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_media');
    }
}
