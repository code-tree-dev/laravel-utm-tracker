<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Tests;

use CodeTreeDev\LaravelUtmTracker\LaravelUtmTracker;
use CodeTreeDev\LaravelUtmTracker\Models\UtmVisit;
use CodeTreeDev\LaravelUtmTracker\Tests\TestCase;

class LaravelUtmTrackerTest extends TestCase
{
    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\LaravelUtmTracker::track
     */
    public function it_creates_a_utm_visit_record()
    {
        $data = [
            'utm_source' => 'google',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'promo',
            'utm_term' => 'test',
            'utm_content' => 'banner',
            'utm_extra' => ['foo' => 'bar'],
            'page_url' => 'https://example.com',
            'referrer' => 'https://referrer.com',
            'session_id' => 'abc123',
            'ip_address' => '127.0.0.1',
            'user_agent' => 'test-agent',
        ];

        $visit = LaravelUtmTracker::track($data);

        $this->assertInstanceOf(UtmVisit::class, $visit);
        $this->assertDatabaseHas('utm_visits', [
            'utm_source' => 'google',
            'utm_medium' => 'cpc',
            'utm_campaign' => 'promo',
        ]);
        $this->assertEquals(['foo' => 'bar'], $visit->utm_extra);
    }

    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\LaravelUtmTracker::track
     */
    public function it_ignores_non_fillable_fields()
    {
        $data = [
            'utm_source' => 'facebook',
            'non_fillable' => 'should_be_ignored',
        ];

        $visit = LaravelUtmTracker::track($data);

        $this->assertInstanceOf(UtmVisit::class, $visit);
        $this->assertDatabaseHas('utm_visits', [
            'utm_source' => 'facebook',
        ]);
        $this->assertArrayNotHasKey('non_fillable', $visit->getAttributes());
    }
}
