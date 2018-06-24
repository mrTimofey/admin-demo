<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	protected function createImages($count): \Illuminate\Database\Eloquent\Collection {
		$existingFiles = app('files')->files(\MrTimofey\LaravelAioImages\ImageModel::getUploadPath());
		$images = new \Illuminate\Database\Eloquent\Collection();
		if (count($existingFiles) === 0) {
			$i = $count;
			$this->command->line('Uploading ' . $count . ' random images');
			/** @var \Illuminate\Console\OutputStyle $output */
			$output = $this->command->getOutput();
			$progress = $output->createProgressBar($count);
			while ($i-- > 0) {
				try {
					$images->push(\MrTimofey\LaravelAioImages\ImageModel::upload(
						'https://picsum.photos/' .
							random_int(400, 800) . '/' .
							random_int(400, 800) . '?random',
						['ext' => 'jpg']
					));
				} catch (\Throwable $e) {}
				$progress->advance();
			}
			$progress->finish();
			$output->newLine();
		} else {
			$this->command->line('Writing existing images to database');
			/** @var \Symfony\Component\Finder\SplFileInfo $file */
			foreach ($existingFiles as $file) {
				$images->push(\MrTimofey\LaravelAioImages\ImageModel::query()->create([
					'id' => $file->getFilename(),
					'props' => []
				]));
			}
		}
		return $images;
	}

	public function run(): void {
		$images = $this->createImages(50);
		factory(\App\Models\PostCategory::class, 20)->create();
		/** @var \Illuminate\Database\Eloquent\Collection $tags */
		$tags = factory(\App\Models\Tag::class, 100)->create();
		factory(\App\Models\Post::class, 80)->create()->each(function(\App\Models\Post $post) use($tags) {
			/** @noinspection ExceptionsAnnotatingAndHandlingInspection */
			$post->tags()->attach($tags->random(random_int(0, 10)));
		});
		factory(\App\Models\Album::class, 20)->create()->each(function(\App\Models\Album $album) use($images) {
			$album->images()->attach($images->random(random_int(1, 10)));
		});
	}
}
