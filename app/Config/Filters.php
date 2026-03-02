<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AdminFilter;
use App\Filters\PimpinanFilter;
use App\Filters\ManagerialFilter;
use App\Filters\SupervisorFilter;
use App\Filters\KepalaUnitFilter;
use App\Filters\StaffFilter;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'admin'         => AdminFilter::class,
        'pimpinan'      => PimpinanFilter::class,
        'managerial'    => ManagerialFilter::class,
        'supervisor'    => SupervisorFilter::class,
        'kepalaunit'    => KepalaUnitFilter::class,
        'staff'         => StaffFilter::class,
    ];

    public array $globals = [
        'before' => [
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}