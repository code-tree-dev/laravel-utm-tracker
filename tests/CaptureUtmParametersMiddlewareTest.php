<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Tests;

use CodeTreeDev\LaravelUtmTracker\Models\UtmVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

class CaptureUtmParametersMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [\CodeTreeDev\LaravelUtmTracker\LaravelUtmTrackerServiceProvider::class];
    }

    protected function setUp(): void
    {
        parent::setUp();
        // Define uma rota de teste com o middleware web, StartSession e o CaptureUtmParameters
        \Illuminate\Support\Facades\Route::middleware([
            'web',
            \Illuminate\Session\Middleware\StartSession::class,
            \CodeTreeDev\LaravelUtmTracker\Middleware\CaptureUtmParameters::class
        ])->get('/test-utm', fn () => 'ok');
    }

    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\Middleware\CaptureUtmParameters::handle
     */
    public function it_creates_utm_visit_when_utm_parameters_are_present()
    {
        $response = $this->get('/test-utm?utm_source=google&utm_medium=cpc&utm_campaign=promo&utm_custom=foo');
        $response->assertOk();

        $this->assertDatabaseHas('utm_visits', [
            'utm_source' => 'google',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'promo',
        ]);
        $visit = UtmVisit::first();
        $this->assertArrayHasKey('utm_custom', $visit->utm_extra);
        $this->assertEquals('foo', $visit->utm_extra['utm_custom']);
    }

    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\Middleware\CaptureUtmParameters::handle
     */
    public function it_does_not_create_utm_visit_when_no_utm_parameters()
    {
        $response = $this->get('/test-utm');
        $response->assertOk();
        $this->assertDatabaseCount('utm_visits', 0);
    }
}
