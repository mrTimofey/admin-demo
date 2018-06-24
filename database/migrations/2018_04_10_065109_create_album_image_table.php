<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumImageTable extends Migration {
	public function up(): void {
		Schema::create('album_image', function(Blueprint $table) {
			$table->unsignedInteger('album_id');
			$table->unsignedInteger('image_id');
			$table->smallInteger('sort')->default(0);
			$table->primary(['album_id', 'image_id']);
			$table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
			$table->foreign('image_id')->references('id')->on('aio_images')->onDelete('cascade');
		});
	}

	public function down(): void {
		Schema::dropIfExists('album_image');
	}
}
