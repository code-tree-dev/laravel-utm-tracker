<?php

declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as OrchestraTestbench;

abstract class TestCase extends OrchestraTestbench
{
    protected function setUp(): void
    {
        parent::setUp();
        // Carrega as migrations do package
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        // Executa as migrations
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--database' => 'testbench']);
    }

    protected function getEnvironmentSetUp($app): void
    {
        // Configura o database para sqlite in-memory
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
        // Garante que existe uma chave de aplicação
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        // Garante que o driver de sessão é array (ideal para testes)
        $app['config']->set('session.driver', 'array');
    }
}
