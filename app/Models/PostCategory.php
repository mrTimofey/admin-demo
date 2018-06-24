<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MrTimofey\EloquentSluggable\Sluggable;
use MrTimofey\LaravelAdminApi\Contracts\ConfiguresAdminHandler;
use MrTimofey\LaravelAdminApi\ModelHandler;

class PostCategory extends Model implements ConfiguresAdminHandler {
	use Sluggable;

	public $timestamps = false;

	public function posts(): HasMany {
		return $this->hasMany(Post::class);
	}

	public function getForeignKey(): string {
		return 'category_id';
	}

	public function configureAdminHandler(ModelHandler $handler): void {
		$handler->setTitle('Categories')
			->addPreQueryModifier(function(Builder $q) {
				$q->withCount('posts');
			})
			->setSearchableFields(['id', 'name', 'slug'])
			->setIndexFields([
				'id',
				'sort' => ['type' => 'int', 'editable' => true, 'sortable' => true],
				'slug',
				'name',
				'posts_count'
			])
			->setItemFields([
				'name',
				'slug' => ['title' => 'Slug <small class="text-muted">generated automatically from name by default</small>', 'placeholder' => 'Generate from name'],
				'sort' => ['type' => 'int', 'default' => 0]
			])
			->setValidationRules([
				'name' => ['required'],
				'slug' => ['nullable', $this->slugUniqueValidationRule()],
				'sort' => ['required']
			]);
	}
}