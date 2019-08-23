<?php

declare(strict_types=1);

namespace App\Document\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class DocumentPatchController
{

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        return $response;
    }
}
