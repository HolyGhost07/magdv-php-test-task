<?php

declare(strict_types=1);

namespace App;

use Slim\App;
use App\Controllers\DebugController;
use App\Document\Controllers\DocumentGetController;
use App\Document\Controllers\DocumentPostController;
use App\Document\Controllers\DocumentPatchController;

class Routes
{

    /**
     * @param App $app
     * @return void
     */
    public static function register(App $app): void
    {
        $app->redirect('/', '/debug/info', 301);

        $app->group('/debug', function (App $app) {
            $app->get('/info[/]', DebugController::class . ':info');
            $app->get('/ping[/]', DebugController::class . ':ping');
            $app->get(
                '/connection/check[/]',
                DebugController::class . ':checkConnection'
            );
        });

        $app->group('/api/v1', function (App $app) {
            $app->get(
                '/documents/{id}[/]',
                DocumentGetController::class . ':findOne'
            );
            $app->get(
                '/documents[/]',
                DocumentGetController::class . ':search'
            );
            $app->post(
                '/documents[/]',
                DocumentPostController::class . ':create'
            );
            $app->post(
                '/documents/{id}/publish[/]',
                DocumentPostController::class . ':publish'
            );
            $app->patch('/documents/{id}[/]', DocumentPatchController::class);
        });
    }
}
