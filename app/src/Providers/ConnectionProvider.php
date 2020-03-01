<?php

declare(strict_types=1);

namespace App\Providers;

use Pimple\Container;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Pimple\ServiceProviderInterface;
use App\Document\Doctrine\DBAL\Types\DocumentStatusType;
use App\Document\Doctrine\DBAL\Types\DocumentPayloadType;

class ConnectionProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function register(Container $pimple): void
    {
        $pimple['EntityManager'] = function () {
            // Create a simple Doctrine ORM configuration for Annotations
            $config = Setup::createAnnotationMetadataConfiguration(
                [ROOT_PATH . '/src'],
                true
            );

            // database configuration parameters
            $connection = [
                'driver'   => 'pdo_mysql',
                'host'     => getenv('MYSQL_HOST'),
                'port'     => getenv('MYSQL_PORT'),
                'dbname'   => getenv('MYSQL_DATABASE'),
                'user'     => getenv('MYSQL_USER'),
                'password' => getenv('MYSQL_PASSWORD'),
                'charset'  => getenv('MYSQL_CHARSET'),
            ];

            Type::addType(
                'uuid_binary_ordered_time',
                'Ramsey\Uuid\Doctrine\UuidBinaryOrderedTimeType'
            );
            Type::addType(
                DocumentStatusType::NAME,
                DocumentStatusType::class
            );
            Type::addType(
                DocumentPayloadType::NAME,
                DocumentPayloadType::class
            );

            // Obtaining the entity manager
            $em = EntityManager::create($connection, $config);
            $em->getConnection()
                ->getDatabasePlatform()
                    ->registerDoctrineTypeMapping(
                        'uuid_binary_ordered_time',
                        'binary'
                    );
            
            return $em;
        };
    }
}
