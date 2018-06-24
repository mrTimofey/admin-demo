<?php

/** @var \Illuminate\Foundation\Console\Kernel $this */

$this->command('make:user', function() {
	/** @var \Illuminate\Foundation\Console\ClosureCommand $this */

	\App\User::query()->updateOrCreate(['email' => 'admin@admin.com'], [
		'name' => 'Admin',
		'password' => 'secret'
	]);
	$this->info('User with admin@admin.com / secret credentials created');
});

$this->command('reset {--hard}', function(bool $hard, \Illuminate\Foundation\Console\Kernel $console) {
	if ($hard) {
		/** @var \Illuminate\Filesystem\Filesystem $fs */
		$fs = app('files');
		$fs->cleanDirectory(\MrTimofey\LaravelAioImages\ImageModel::getUploadPath());
	}
	$console->call('down', [], $this->output);
	$console->call('migrate:fresh', ['--force' => true], $this->output);
	$console->call('db:seed', ['--force' => true], $this->output);
	$console->call('make:user', [], $this->output);
	$console->call('up', [], $this->output);
});
