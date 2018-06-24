<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {
	public function up(): void {
		Schema::create('albums', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('summary')->nullable();
			$table->string('slug')->unique();
		});
	}

	public function down(): void {
		Schema::dropIfExists('albums');
	}
}
