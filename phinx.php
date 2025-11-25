<?php

use Dotenv\Dotenv;

$root = __DIR__;
if (file_exists($root . '/.env')) {
    $dotenv = Dotenv::createImmutable($root);
    $dotenv->load();
}

return [
    'paths' => [
        'migrations' => 'db/migrations',
        'seeds' => 'db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'dev',
        'dev' => [
            'adapter' => $_ENV['mysql'] ?? 'mysql',
            'host' => $_ENV['127.0.0.1'] ?? '127.0.0.1',
            'name' => $_ENV['meu_crud_db'] ?? 'meu_crud_db',
            'user' => $_ENV['root'] ?? 'root',
            'pass' => $_ENV['RFHsKZfMhQIjwMCFIfRtybZWroRfoXTy'] ?? '', // Deixando a senha vazia por padrão é mais comum
            'port' => (int)($_ENV['3306'] ?? 3306),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci'
        ]
    ],
    'version_order' => 'creation'
];
