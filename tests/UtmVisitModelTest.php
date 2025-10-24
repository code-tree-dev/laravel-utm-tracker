<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Tests;

use CodeTreeDev\LaravelUtmTracker\Models\UtmVisit;

class UtmVisitModelTest extends TestCase
{
    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\Models\UtmVisit
     */
    public function it_has_fillable_fields()
    {
        $model = new UtmVisit();
        $this->assertEquals([
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
            'utm_extra',
            'page_url',
            'referrer',
            'session_id',
            'ip_address',
            'user_agent',
        ], $model->getFillable());
    }

    /**
     * @test
     * @covers \CodeTreeDev\LaravelUtmTracker\Models\UtmVisit
     */
    public function it_casts_utm_extra_to_array()
    {
        $model = new UtmVisit([
            'utm_extra' => ['foo' => 'bar'],
        ]);
        $this->assertIsArray($model->utm_extra);
        $this->assertEquals(['foo' => 'bar'], $model->utm_extra);
    }
}
