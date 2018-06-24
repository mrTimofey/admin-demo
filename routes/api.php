<?php

/** @var \Illuminate\Routing\Router $router */

$router->get('demo/images', function (): \Illuminate\Http\JsonResponse {
    return response()->json(\MrTimofey\LaravelAioImages\ImageModel::query()->inRandomOrder()->limit(random_int(1, 5))->pluck('id'));
});

