<?php

declare(strict_types=1);

namespace App\Controllers;

use PDO;
use PDOException;
use Slim\Http\Request;
use Slim\Http\Response;

class DebugController
{

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function info(Request $request, Response $response): Response
    {
        phpinfo();

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function ping(Request $request, Response $response): Response
    {
        $response = $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200)
            ->withJson(['ping' => 'pong', 'code' => 200]);

        return $response;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function checkConnection(
        Request $request,
        Response $response
    ): Response {
        $host = getenv('MYSQL_HOST');
        $db = getenv('MYSQL_DATABASE');
        $port = getenv('MYSQL_PORT');
        $username = (string)getenv('MYSQL_USER');
        $password = (string)getenv('MYSQL_PASSWORD');

        $dsn = "mysql:host=$host;port=$port;dbname=$db";
        try {
            $conn = new PDO($dsn, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $response = $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200)
                ->withJson([
                    'dsn' => $dsn,
                    'message' => 'Connected successfully',
                    'code' => 200,
                ]);
        } catch (PDOException $e) {
            $response = $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(503)
                ->withJson([
                    'dsn' => $dsn,
                    'message' => 'Connection failed: ' . $e->getMessage(),
                    'code' => 503,
                ]);
        }

        return $response;
    }
}
