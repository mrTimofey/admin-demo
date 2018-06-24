<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use MrTimofey\LaravelAdminApi\Contracts\ConfiguresAdminHandler;
use MrTimofey\LaravelAdminApi\ModelHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class User extends Authenticatable implements ConfiguresAdminHandler {
	use Notifiable;

	protected $fillable = [
		'name', 'email', 'password', 'avatar_image_id'
	];

	protected $visible = [
		'id', 'name', 'email', 'avatar_image_id'
	];

	protected $hidden = [
		'password', 'remember_token'
	];

	public function setPasswordAttribute(string $v): void {
		if (!$v || ($this->attributes['password'] ?? null === $v) || $this->getKey() === 1) return;
		$this->attributes['password'] = app('hash')->make($v);
	}

	public function configureAdminHandler(ModelHandler $handler): void {
		$handler->allowActions(['index'])
			->setTitle(trans('admin.entities.' . $handler->getName()))
			->setIndexFields([
				'id', 'name', 'email'
			])
			->setItemFields([
				'name',
				'email',
				'password',
				'avatar_image_id' => [
					'type' => 'image',
					'title' => 'Avatar'
				]
			]);
	}
}
