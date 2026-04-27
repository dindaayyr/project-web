<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class DbSetup extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:setup';
    protected $description = 'Create database, run migrations, and seed data automatically.';

    public function run(array $params)
    {
        $dbConfig = config('Database');
        $default  = $dbConfig->default;

        $host     = $default['hostname'];
        $user     = $default['username'];
        $pass     = $default['password'];
        $database = $default['database'];

        CLI::write("Starting database setup for: $database", 'yellow');

        // 1. Create Database if not exists
        try {
            $mysqli = new \mysqli($host, $user, $pass);
            if ($mysqli->connect_error) {
                CLI::error("Connection failed: " . $mysqli->connect_error);
                return;
            }

            if ($mysqli->query("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci")) {
                CLI::write("Database '$database' is ready.", 'green');
            } else {
                CLI::error("Error creating database: " . $mysqli->error);
                return;
            }
            $mysqli->close();
        } catch (\Exception $e) {
            CLI::error("Failed to ensure database existence: " . $e->getMessage());
            return;
        }

        // 2. Run Migrations
        CLI::write("Running migrations...", 'yellow');
        $migrate = \Config\Services::migrations();
        try {
            $migrate->setNamespace('App');
            if ($migrate->latest()) {
                CLI::write("Migrations completed successfully.", 'green');
            }
        } catch (\Throwable $e) {
            CLI::error("Migration failed: " . $e->getMessage());
        }

        // 3. Run Seeder
        CLI::write("Seeding data...", 'yellow');
        $seeder = \Config\Services::seeder();
        try {
            $seeder->call('DatabaseSeeder');
            CLI::write("Seeding completed successfully.", 'green');
        } catch (\Throwable $e) {
            CLI::error("Seeding failed: " . $e->getMessage());
        }

        CLI::write("Database setup is complete! You can now use the application.", 'cyan');
    }
}
