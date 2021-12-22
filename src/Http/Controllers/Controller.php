<?php

declare(strict_types=1);

namespace DragonCode\WebAppSupport\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function json(mixed $data = null, int $status = null, array $with = []): JsonResponse
    {
        return api_response($data, $status, $with);
    }
}
