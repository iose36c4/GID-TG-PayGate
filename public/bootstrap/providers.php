<?php

use App\Domains\Creadores\Providers\CreadoresServiceProvider;
use App\Domains\Public\Providers\PublicServiceProvider;
use App\Domains\Staff\Providers\StaffServiceProvider;
use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    PublicServiceProvider::class,
    CreadoresServiceProvider::class,
    StaffServiceProvider::class,
];
