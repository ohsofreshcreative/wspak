<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Tabs extends Block
{
    public $name = 'Zakładki';
    public $description = 'tabs';
    public $slug = 'tabs';
    public $category = 'formatting';
    public $icon = 'table-row-after';
    public $keywords = ['tabs', 'kafelki'];
    public $mode = 'edit';
    public $supports = [
        'align' => false,
        'mode' => false,
        'jsx' => true,
    ];

    public function fields()
    {
        $tabs = new FieldsBuilder('tabs');

        $tabs
            ->setLocation('block', '==', 'acf/tabs')
            ->addText('block-title', [
                'label' => 'Tytuł',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Zakładki',
                'open' => false,
                'multi_expand' => true,
            ])
            ->addTab('Treści', ['placement' => 'top'])
            ->addGroup('g_tabs', ['label' => ''])
            ->addText('header', ['label' => 'Nagłówek'])
            ->addTextarea('text', [
                'label' => 'Opis',
                'rows' => 4,
                'new_lines' => 'br',
            ])
            ->addLink('button', [
                'label' => 'Przycisk',
                'return_format' => 'array',
            ])
            ->endGroup()
            ->addTab('Kafelki', ['placement' => 'top'])
            ->addRepeater('r_tabs', [
                'label' => 'Kafelki',
                'layout' => 'table',
                'min' => 1,
                'button_label' => 'Dodaj kafelek'
            ])
            ->addText('tab', [
                'label' => 'Nazwa zakładki',
                'required' => 1,
            ])
            ->addGallery('images', [
                'label' => 'Galeria zdjęć',
                'return_format' => 'array',
                'preview_size' => 'medium',
            ])
            ->addText('title', [
                'label' => 'Nagłówek',
            ])
          ->addWysiwyg('text', [
				'label' => 'Treść',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => true,
			])
            ->endRepeater()
            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addText('section_id', [
                'label' => 'ID',
            ])
            ->addText('section_class', [
                'label' => 'Dodatkowe klasy CSS',
            ])
            ->addTrueFalse('flip', ['label' => 'Odwrotna kolejność', 'ui' => 1])
            ->addTrueFalse('wide', ['label' => 'Szeroka kolumna', 'ui' => 1])
            ->addTrueFalse('nomt', ['label' => 'Usunięcie marginesu górnego', 'ui' => 1])
            ->addTrueFalse('gap', ['label' => 'Większy odstęp', 'ui' => 1])
            ->addSelect('background', [
                'label' => 'Kolor tła',
                'choices' => [
                    'none' => 'Brak (domyślne)',
                    'section-white' => 'Białe',
                    'section-light' => 'Jasne',
                    'section-gray' => 'Szare',
                    'section-brand' => 'Marki',
                    'section-gradient' => 'Gradient',
                    'section-dark' => 'Ciemne',
                ],
                'default_value' => 'none',
            ]);

        return $tabs;
    }

    public function with()
    {
        return [
            'g_tabs' => get_field('g_tabs'),
            'r_tabs' => get_field('r_tabs'),
            'section_id' => get_field('section_id'),
            'section_class' => get_field('section_class'),
            'flip' => get_field('flip'),
            'wide' => get_field('wide'),
            'nomt' => get_field('nomt'),
            'gap' => get_field('gap'),
            'background' => get_field('background'),
        ];
    }
}