<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {
	protected $namespace = 'App\Http\Controllers';

	public function map(): void {
		$this->app->make('router')->group([
			'prefix' => config('admin_api.api_prefix'),
			'middleware' => config('admin_api.api_middleware'),
			'namespace' => $this->namespace
		], base_path('routes/api.php'));
	}
}
