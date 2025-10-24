<?php

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
    protected static function getFacadeAccessor()
    {
        return 'laravel-utm-tracker';
    }
}
