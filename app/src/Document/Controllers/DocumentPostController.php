<?php

declare(strict_types=1);

namespace App\Document\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Document\DocumentService;
use App\Exceptions\ServiceException;

class DocumentPostController
{

    /** @var DocumentService */
    private $service;

    /**
     * @param DocumentService $service
     */
    public function __construct(DocumentService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function create(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $response = $response->withHeader('Content-Type', 'application/json');

        try {
            $document = $this->service->create();

            $response = $response
                ->withStatus(200)
                ->withJson(['document' => $document]);
        } catch (ServiceException $e) {
            $response = $response
                ->withStatus($e->getCode())
                ->withJson(['errors' => [$e->getMessage()]]);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function publish(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $response = $response->withHeader('Content-Type', 'application/json');

        try {
            $document = $this->service->publish($request->getAttribute('id'));

            $response = $response
                ->withStatus(200)
                ->withJson(['document' => $document]);
        } catch (ServiceException $e) {
            $response = $response
                ->withStatus($e->getCode())
                ->withJson(['errors' => [$e->getMessage()]]);
        }

        return $response;
    }
}
