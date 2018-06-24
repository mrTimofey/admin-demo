<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
			$table->string('slug')->unique();
			$table->string('image_id')->nullable();
			$table->text('summary');
            $table->text('content');
            $table->unsignedInteger('category_id')->nullable();
            $table->jsonb('meta')->nullable();

            $table->foreign('image_id')->references('id')->on('aio_images')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('post_categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}
