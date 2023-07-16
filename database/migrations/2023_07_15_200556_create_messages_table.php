<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chat_id');

            $table->bigInteger('message_id');

            $table->string('date')->nullable();
            $table->longText('text')->nullable();
            $table->string('language_code')->nullable();

            $table->string('theme')->default('none');
            $table->boolean('read')->default(false);

            $table->string('type')->default('in')->comment('in or out message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
