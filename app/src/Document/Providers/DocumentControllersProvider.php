<?php

declare(strict_types=1);

namespace App\Document\Providers;

use Pimple\Container;
use App\Document\DocumentService;
use Pimple\ServiceProviderInterface;
use App\Document\Controllers\DocumentGetController;
use App\Document\Controllers\DocumentPostController;

class DocumentControllersProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register(Container $pimple)
    {
        $pimple[DocumentGetController::class] = function (
            Container $container
        ) {
            return new DocumentGetController(
                $container[DocumentService::class]
            );
        };

        $pimple[DocumentPostController::class] = function (
            Container $container
        ) {
            return new DocumentPostController(
                $container[DocumentService::class]
            );
        };
    }
}
