<?php

namespace App\Providers;

use Log1x\AcfComposer\Provider;

class AcfServiceProvider extends Provider
{
    /**
     * The field groups registered by the provider.
     *
     * @var array<class-string>
     */
    protected $fields = [
        \App\Fields\PageHero::class,
        \App\Fields\FlexibleContent::class,
    ];
}
