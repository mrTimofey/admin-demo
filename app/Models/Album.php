<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MrTimofey\EloquentSluggable\Sluggable;
use MrTimofey\LaravelAdminApi\Contracts\ConfiguresAdminHandler;
use MrTimofey\LaravelAdminApi\ModelHandler;
use MrTimofey\LaravelAioImages\ImageModel;

class Album extends Model implements ConfiguresAdminHandler {
	use Sluggable;

	public function images(): BelongsToMany {
		return $this->belongsToMany(ImageModel::class, 'album_image');
	}

	public function configureAdminHandler(ModelHandler $handler): void {
		$handler->setTitle('Albums')
			->setSearchableFields(['id', 'name', 'slug'])
			->setIndexFields([
				'id',
				'created_at',
				'slug',
				'name'
			])
			->setItemFields([
				'name',
				'slug' => ['title' => 'Slug <small class="text-muted">generated automatically from name by default</small>', 'placeholder' => 'Generate from name'],
				'images' => ['type' => 'gallery'],
				'summary' => ['type' => 'wysiwyg']
			])
			->setValidationRules([
				'name' => ['required'],
				'slug' => ['nullable', $this->slugUniqueValidationRule()],
				'images' => ['array', 'min:1']
			]);
	}
}