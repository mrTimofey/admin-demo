<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagTable extends Migration {
	public function up(): void {
		Schema::create('post_tag', function(Blueprint $table) {
			$table->unsignedInteger('post_id');
			$table->unsignedInteger('tag_id');
			$table->primary(['post_id', 'tag_id']);
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
		});
	}

	public function down(): void {
		Schema::dropIfExists('post_tag');
	}
}
