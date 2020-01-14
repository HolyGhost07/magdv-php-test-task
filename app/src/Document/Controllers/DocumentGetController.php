<?php

declare(strict_types=1);

namespace App\Document\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Document\DocumentService;
use App\Exceptions\ServiceException;

class DocumentGetController
{

    /**
     * @var DocumentService
     * */
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
    public function findOne(
        Request $request,
        Response $response,
        array $args
    ): Response {
        try {
            $document = $this->service->findOne($request->getAttribute('id'));

            $response = $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->withJson([
                    'document' => $document,
                ]);
        } catch (ServiceException $e) {
            $response = $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($e->getCode())
                ->withJson([
                    'status' => $e->getCode(),
                    'errors' => [$e->getMessage()],
                ]);
        }

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function search(
        Request $request,
        Response $response,
        array $args
    ): Response {
        try {
            $response = $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->withJson([
                    'documents' => $this->service->find(),
                ]);
        } catch (ServiceException $e) {
            $response = $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus($e->getCode())
                ->withJson([
                    'status' => $e->getCode(),
                    'errors' => [$e->getMessage()],
                ]);
        }

        return $response;
    }
}
