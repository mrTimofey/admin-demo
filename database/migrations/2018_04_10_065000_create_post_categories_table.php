<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostCategoriesTable extends Migration {
	public function up(): void {
		Schema::create('post_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug')->unique();
			$table->smallInteger('sort')->default(0);
		});
	}

	public function down(): void {
		Schema::dropIfExists('post_categories');
	}
}
