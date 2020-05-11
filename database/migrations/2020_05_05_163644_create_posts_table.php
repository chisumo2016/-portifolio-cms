<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id'); //user

            $table->string('title');
            $table->longText('content');
            $table->string('description');
            $table->string('slug');
            $table->longText('header_img');
            $table->boolean('status')->default(0);
            $table->dateTime('published_on')->nullable();
            //$table->dateTime('publish_at');

            //$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
