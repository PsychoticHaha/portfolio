<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Concerns\PreparesData;

class PageHero extends Builder
{
    use PreparesData;

    /**
     * The field group key.
     *
     * @var string
     */
    public $name = 'page_hero';

    /**
     * The ACF field group title.
     *
     * @var string
     */
    public $title = 'Page Hero';

    /**
     * Register the ACF field group.
     *
     * @return array
     */
    public function fields(): array
    {
        return $this->group($this->name, [
            $this->text('eyebrow', [
                'label' => 'Eyebrow',
                'instructions' => 'Short label displayed above the headline.',
            ]),
            $this->text('headline', [
                'label' => 'Headline',
                'required' => 1,
            ]),
            $this->textarea('subheadline', [
                'label' => 'Subheadline',
                'rows' => 3,
            ]),
            $this->repeater('hero_actions', [
                'label' => 'Hero Actions',
                'layout' => 'table',
                'button_label' => 'Add Action',
                'required' => 0,
            ])->fields([
                $this->text('label', [
                    'label' => 'Label',
                    'required' => 1,
                ]),
                $this->url('url', [
                    'label' => 'URL',
                    'required' => 1,
                ]),
                $this->select('style', [
                    'label' => 'Style',
                    'choices' => [
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                        'ghost' => 'Ghost',
                    ],
                    'default_value' => 'primary',
                ]),
            ]),
            $this->image('media', [
                'label' => 'Hero Media',
                'instructions' => 'Optional supporting image or illustration.',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ]),
        ]);
    }

    /**
     * Set the field group location rules.
     *
     * @return array
     */
    public function location(): array
    {
        return [
            $this->location('page_template', '==', 'template-landing.blade.php'),
        ];
    }
}
