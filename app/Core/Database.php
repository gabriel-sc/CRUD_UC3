<?php

namespace App\Core;

use Dotenv\Dotenv;
use PDO;

class Database
{
    private static ?PDO $conn = null;

    public static function getConnection(): PDO
    {
        $root = dirname(__DIR__, 2);

        // Carrega .env se existir
        if (file_exists($root . '/.env')) {
            $dotenv = Dotenv::createImmutable($root);
            $dotenv->load();
        }

        if (!self::$conn) {

            // Variáveis de ambiente com valores padrão
            $driver = $_ENV['mysql'] ?? 'mysql';
            $host   = $_ENV['127.0.0.1']   ?? '127.0.0.1';
            $port   = $_ENV['3306']   ?? '3306';
            $name   = $_ENV['crud_main']   ?? 'crud_main';
            $user   = $_ENV['root']   ?? 'root';
            $pass   = $_ENV['']   ?? '';

            // DSN correto
            $dsn = sprintf(
                "%s:host=%s;port=%s;dbname=%s;charset=utf8mb4",
                $driver,
                $host,
                $port,
                $name
            );

            // Conexão PDO
            self::$conn = new PDO($dsn, $user, $pass);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }

        return self::$conn;
    }
}
