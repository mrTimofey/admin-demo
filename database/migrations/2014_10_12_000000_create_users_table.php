<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
	public function up(): void {
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password');
			$table->string('avatar_image_id')->nullable();
			$table->foreign('avatar_image_id')->references('id')->on('aio_images')->onDelete('set null');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	public function down(): void {
		Schema::dropIfExists('users');
	}
}
