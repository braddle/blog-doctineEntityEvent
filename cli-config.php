<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

$paths = [
    __DIR__ . '/config',
];

$databaseConfig = [
    'driver' => 'pdo_sqlite',
    'path'   => __DIR__ . '/db.sqlite',
];

$config = Setup::createYAMLMetadataConfiguration($paths, true);
$entityManager = EntityManager::create($databaseConfig, $config);

return ConsoleRunner::createHelperSet($entityManager);
