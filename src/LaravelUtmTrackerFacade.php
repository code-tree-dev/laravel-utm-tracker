<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CodeTreeDev\LaravelUtmTracker\Skeleton\SkeletonClass
 */
class LaravelUtmTrackerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-utm-tracker';
    }
}
