<?php

namespace App\Http\Controllers\Api\Payload;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;

class ErrorMessage extends \RuntimeException implements Responsable
{
    /**
     * @Property()
     * @var string
     */
    protected $message;

    public function toResponse($request)
    {
        return new JsonResponse(['message' => $this->message], $this->getCode() ?: 400);
    }
}
