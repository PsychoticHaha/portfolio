<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class Landing extends Composer
{
    /**
     * Views served by this composer.
     *
     * @var array<string>
     */
    protected static $views = [
        'template-landing',
    ];

    /**
     * Compose the view data.
     */
    public function with(): array
    {
        if (! function_exists('get_fields')) {
            return [
                'hero' => null,
                'sections' => [],
            ];
        }

        $fields = get_fields() ?: [];

        return [
            'hero' => $fields['page_hero'] ?? null,
            'sections' => $fields['page_flexible_content']['sections'] ?? [],
        ];
    }
}
