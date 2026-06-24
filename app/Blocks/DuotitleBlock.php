<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class DuotitleBlock extends Block
{
	public $name = 'Sekcja - Bank głosów';
	public $description = 'duotitle - text oraz zdjęcie';
	public $slug = 'duotitle-block';
	public $category = 'formatting';
	public $keywords = ['tresc', 'zdjecie', 'duotitle' ];
	public $mode = 'edit';
public $supports = [
    'align' => false,
    'mode' => false, 
    'jsx' => true,
    'anchor' => true,
    'customClassName' => true,
];

	public function fields()
    {
        $duotitleBlock = new FieldsBuilder('duotitle-block');

        $duotitleBlock
            ->setLocation('block', '==', 'acf/duotitle-block')
            ->addText('block-title', [
                'label' => 'Tytuł lokalny (w edytorze)',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Informacje i ustawienia',
                'open' => false,
                'multi_expand' => true,
            ])

            /*--- KARTA 1: INFORMACJE ---*/
            ->addTab('Informacja', ['placement' => 'top'])
            ->addMessage(
                'info',
                'Treści duotitle edytujesz globalnie w zakładce "Sekcja - Bank głosów" w menu bocznym WP.'
            )

            /*--- KARTA 2: USTAWIENIA WIZUALNE BLOKU ---*/
            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addText('section_id', ['label' => 'ID'])
            ->addText('section_class', ['label' => 'Dodatkowe klasy CSS'])
            ->addTrueFalse('flip', [
                'label' => 'Odwrotna kolejność',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('wide', [
                'label' => 'Szeroka kolumna',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('nomt', [
                'label' => 'Usunięcie marginesu górnego',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('gap', [
                'label' => 'Większy odstęp',
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
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
					'section-blue' => 'Jasnoniebieskie (#E7F2FF)',
                ],
                'default_value' => 'none',
                'allow_null' => 0,
            ]);

        return $duotitleBlock->build();
    }

    public function with(): array
    {
        $fields = [
            // Pobieranie danych GLOBALNYCH z Options Page ('option')
            'g_duotitle'   => get_field('g_duotitle', 'option') ?: [],

            // Ustawienia LOKALNE konkretnego bloku
            'section_id'    => get_field('section_id'),
            'section_class' => get_field('section_class'),
            'flip'          => (bool) get_field('flip'),
            'wide'          => (bool) get_field('wide'),
            'nomt'          => (bool) get_field('nomt'),
            'gap'           => (bool) get_field('gap'),
            'background'    => get_field('background') ?: 'none',
        ];

        $fields['sectionClass'] = SectionClasses::fromMap($fields, [
            'flip' => 'order-flip',
            'wide' => 'wide',
            'nomt' => '!mt-0',
            'gap'  => 'wider-gap',
        ]);

        return $fields;
    }
}