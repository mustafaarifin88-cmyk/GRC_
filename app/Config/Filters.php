<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use App\Filters\AuthFilter;
use App\Filters\AdminFilter;
use App\Filters\StaffFilter;
use App\Filters\LeaderFilter;

class Filters extends BaseConfig
{
    public array $aliases = [
        'csrf'     => CSRF::class,
        'toolbar'  => DebugToolbar::class,
        'honeypot' => Honeypot::class,
        'auth'     => AuthFilter::class,
        'admin'    => AdminFilter::class,
        'staff'    => StaffFilter::class,
        'leader'   => LeaderFilter::class,
    ];

    public array $globals = [
        'before' => [
            // 'csrf',
        ],
        'after' => [
            'toolbar',
        ],
    ];

    public array $methods = [];

    public array $filters = [
        'auth'   => ['before' => ['admin/*', 'staff/*', 'kepala_unit/*', 'supervisor/*', 'managerial/*', 'pimpinan_tinggi/*']],
        'admin'  => ['before' => ['admin/*']],
        'staff'  => ['before' => ['staff/*']],
        'leader' => ['before' => ['kepala_unit/*', 'supervisor/*', 'managerial/*', 'pimpinan_tinggi/*']],
    ];
}