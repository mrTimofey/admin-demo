<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use MrTimofey\EloquentSluggable\Sluggable;
use MrTimofey\LaravelAdminApi\Contracts\ConfiguresAdminHandler;
use MrTimofey\LaravelAdminApi\ModelHandler;

class Post extends Model implements ConfiguresAdminHandler {
	use Sluggable;

	/**
	 * @var string
	 */
	protected static $slugSource = 'title';

	protected $casts = [
		'meta' => 'array'
	];

	public function category(): BelongsTo {
		return $this->belongsTo(PostCategory::class);
	}

	public function tags(): BelongsToMany {
		return $this->belongsToMany(Tag::class);
	}

	public function configureAdminHandler(ModelHandler $handler): void {
		$handler->setTitle('Posts')
			->setSearchableFields(['id', 'slug', 'title', 'summary'])
			->setFilterFields([
				'category', 'tags'
			])
			->setIndexFields([
				'id',
				'created_at',
				'updated_at',
				'slug',
				'title',
				'category',
				'tags'
			])
			->setItemFields([
				'title',
				'slug' => ['title' => 'Slug <small class="text-muted">generated automatically from title by default</small>', 'placeholder' => 'Generate from title'],
				'created_at' => ['default' => 'now'],
				'image_id' => ['title' => 'Preview image', 'type' => 'image'],
				'category' => ['title' => 'Category <small class="text-muted">you can create new category here</small>',
					'allowCreate' => true, 'createDefaults' => ['sort' => 0]],
				'tags' => ['title' => 'Tags <small class="text-muted">you can create new tag here</small>',
					'allowCreate' => true, 'createDefaults' => ['sort' => 0]],
				'summary' => ['type' => 'textarea'],
				'content' => ['type' => 'wysiwyg'],
				'meta' => ['type' => 'key-value']
			])
			->setValidationRules([
				'title' => ['required'],
				'slug' => ['nullable', $this->slugUniqueValidationRule()],
				'summary' => ['required'],
				'content' => ['required'],
				'category' => ['required']
			]);
	}
}