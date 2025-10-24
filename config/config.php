<?php

return [
    // Defines where to store UTM parameters: 'session', 'cookie', or 'database'.
    'storage' => 'session',

    // Default UTM parameters to capture.
    'parameters' => [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
    ],

    // Allows adding custom UTM parameters (in addition to the defaults).
    'custom_parameters' => [
        // e.g. 'utm_custom',
    ],

    // Cookie lifetime (in minutes) if using 'cookie' as storage.
    'cookie_lifetime' => 60 * 24 * 30, // 30 days

    // Enables or disables automatic tracking via middleware.
    'auto_track' => true,

    // Table name for storing records (if using 'database').
    'table' => 'utm_visits',
];