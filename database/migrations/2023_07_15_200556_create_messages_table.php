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
            $table->string('chat_id');
            $table->string('user_id');
            $table->string('first_name')->nullable();
            $table->string('type')->nullable();
            $table->string('date')->nullable();
            $table->longText('text')->nullable();
            $table->string('language_code')->nullable();
            $table->boolean('is_bot')->default(false);

            $table->string('theme')->default('none');

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
