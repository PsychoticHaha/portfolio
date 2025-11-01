<?php

namespace App\Fields;

use Log1x\AcfComposer\Builder;
use Log1x\AcfComposer\Concerns\PreparesData;

class FlexibleContent extends Builder
{
    use PreparesData;

    /**
     * {@inheritdoc}
     */
    public $name = 'page_flexible_content';

    /**
     * {@inheritdoc}
     */
    public $title = 'Page Sections';

    /**
     * {@inheritdoc}
     */
    public function fields(): array
    {
        return $this->group($this->name, [
            $this->flexible('sections', [
                'label' => 'Sections',
                'button_label' => 'Add Section',
            ])
            ->layout('card')
            ->addLayout('Rich Text', [
                $this->text('title', [
                    'label' => 'Section Title',
                ]),
                $this->wysiwyg('content', [
                    'label' => 'Content',
                    'toolbar' => 'basic',
                    'media_upload' => 0,
                ]),
            ])
            ->addLayout('Columns', [
                $this->repeater('columns', [
                    'label' => 'Columns',
                    'button_label' => 'Add Column',
                    'layout' => 'row',
                    'min' => 2,
                    'max' => 3,
                ])->fields([
                    $this->text('heading', [
                        'label' => 'Heading',
                    ]),
                    $this->textarea('body', [
                        'label' => 'Body',
                        'rows' => 5,
                    ]),
                ]),
            ])
            ->addLayout('Call to Action', [
                $this->text('heading', [
                    'label' => 'Heading',
                    'required' => 1,
                ]),
                $this->textarea('body', [
                    'label' => 'Body',
                    'rows' => 3,
                ]),
                $this->link('cta', [
                    'label' => 'Button',
                ]),
            ]),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function location(): array
    {
        return [
            $this->location('page_template', '==', 'template-landing.blade.php'),
        ];
    }
}
