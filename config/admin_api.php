<?php

return [
    /**
     * Admin frontend SPA HTML markup
     * Must be same with vue-admin-front buildDest + index.html
     */
    'frontend_entry' => public_path('admin-dist/index.html'),

    /**
     * Admin frontend SPA HTML markup, catch-all path prefix
     * Must be same with vue-admin-front basePath config
     */
    'frontend_path' => env('ADMIN_ENTRY', '/'),

    /**
     * API path prefix
     * Must be same with vue-admin-front apiRoot config
     */
    'api_prefix' => env('ADMIN_PATH', 'api'),

    /**
     * API guard
     */
    'api_guard' => 'api',

    /**
     * API routes middleware
     */
    'api_middleware' => [
        'auth:api' // should use same guard as api_guard!
    ],

    /**
     * Middleware for authentication API
     */
    'auth_middleware' => ['throttle:5'],

    /**
     * WYSIWYG editor config
     */
    'wysiwyg' => [
        // width/height for uploaded images, remove to use original
        'image_upload_size' => [1280, null],
        // upload image validation
        'image_upload_rules' => ['image', 'max:4096'],
        // external css file path for wysiwyg (use .cke_editable selector as root within this file)
        'css' => null
    ],

    'upload' => [
        /**
         * Where to upload files
         * IMPORTANT: images will not be uploaded here! Images are controlled by mr-timofey/laravel-aio-images package!
         * @see config('aio_images')
         */
        'path' => public_path('storage/uploads'),

        /**
         * HTTP accessible path for uploaded files
         */
        'public_path' => '/storage/uploads',
    ],

    /**
     * Pipe to resize thumbnails.
     * @see https://github.com/mrTimofey/laravel-aio-images
     */
    'thumbnail_pipe' => [['heighten', 120]],

    /**
     * List model classes here
     */
    'models' => [
        App\User::class,
		App\Models\Album::class,
		App\Models\PostCategory::class,
		App\Models\Tag::class,
		App\Models\Post::class
    ],

    /**
     * Main navigation
     */
    'nav' => [
        'Welcome!',
		[
			'title' => 'Examples',
			'icon' => 'fas fa-tachometer-alt',
			'items' => [
				[
					'title' => 'Display types',
					'icon' => 'fas fa-tv',
					'route' => '/displays'
				],
				[
					'title' => 'Field types',
					'icon' => 'fas fa-edit',
					'route' => '/fields'
				]
			]
		],
        [
            'entity' => 'users',
            'icon' => 'far fa-user'
        ],
		[
			'entity' => 'albums',
			'icon' => 'fas fa-image'
		],
		[
			'title' => 'Blog',
			'icon' => 'fab fa-wordpress',
			'items' => [
				[
					'entity' => 'post-categories',
					'icon' => 'fas fa-list-ul'
				],
				[
					'entity' => 'tags',
					'icon' => 'fas fa-tags'
				],
				[
					'entity' => 'posts',
					'icon' => 'fas fa-newspaper'
				]
			]
		]
    ]
];