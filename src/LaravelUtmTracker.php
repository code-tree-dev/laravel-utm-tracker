<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker;

use CodeTreeDev\LaravelUtmTracker\Models\UtmVisit;

class LaravelUtmTracker
{
    /**
     * Create a UTM visit record in the database.
     *
     * @param array $data
     * @return UtmVisit
     */
    public static function track(array $data): UtmVisit
    {
        // Only fillable fields will be accepted
        return UtmVisit::create($data);
    }
}
