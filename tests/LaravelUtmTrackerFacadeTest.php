<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Tests;

use CodeTreeDev\LaravelUtmTracker\LaravelUtmTracker;
use CodeTreeDev\LaravelUtmTracker\Models\UtmVisit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use CodeTreeDev\LaravelUtmTracker\Tests\TestCase;

class LaravelUtmTrackerFacadeTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [\CodeTreeDev\LaravelUtmTracker\LaravelUtmTrackerServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'LaravelUtmTracker' => \CodeTreeDev\LaravelUtmTracker\LaravelUtmTrackerFacade::class,
        ];
    }

    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\LaravelUtmTrackerFacade::track
     */
    public function it_tracks_utm_visit_via_facade()
    {
        $data = [
            'utm_source' => 'newsletter',
            'utm_medium' => 'email',
        ];

        $visit = LaravelUtmTracker::track($data);

        $this->assertInstanceOf(UtmVisit::class, $visit);
        $this->assertDatabaseHas('utm_visits', [
            'utm_source' => 'newsletter',
            'utm_medium' => 'email',
        ]);
    }
}
