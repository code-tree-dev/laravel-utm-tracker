<?php
declare(strict_types=1);

namespace CodeTreeDev\LaravelUtmTracker\Models;

use Illuminate\Database\Eloquent\Model;

final class UtmVisit extends Model
{
    protected $fillable = [
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
    ];

    protected $casts = [
        'utm_extra' => 'array',
    ];
}
