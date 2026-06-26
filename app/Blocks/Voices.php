<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class Voices extends Block
{
	public $name = 'Kafelki z obrazem';
	public $description = 'voices';
	public $slug = 'voices';
	public $category = 'formatting';
	public $icon = 'ellipsis';
	public $keywords = ['voices', 'kafelki'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$voices = new FieldsBuilder('voices');

		$voices
			->setLocation('block', '==', 'acf/voices') // ważne!
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Kafelki',
				'open' => false,
				'multi_expand' => true,
			])
			/*--- TAB #1 ---*/
			->addTab('Treści', ['placement' => 'top'])
			->addGroup('g_voices', ['label' => ''])
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

			/*--- TAB #2 ---*/
			->addTab('Kafelki', ['placement' => 'top'])
			->addRepeater('r_voices', [
				'label' => 'Kafelki',
				'layout' => 'table', // 'row', 'block', albo 'table'
				'min' => 1,
				'button_label' => 'Dodaj kafelek'
			])
			->addImage('image', [
				'label' => 'Obraz',
				'return_format' => 'array', // lub 'url', lub 'id'
				'preview_size' => 'thumbnail',
			])
			->addText('title', [
				'label' => 'Nagłówek',
			])
			->addTextarea('text', [
				'label' => 'Opis',
			])
			->endRepeater()

			/*--- TAB #3 ---*/
			->addTab('Głosy', ['placement' => 'top'])
			->addRepeater('voices', [
				'label' => 'Głosy',
				'layout' => 'table',
				'button_label' => 'Dodaj głos',
			])
			->addText('name', ['label' => 'Imię Lektora'])
			->addText('gender', ['label' => 'Płeć'])
			->addText('age', ['label' => 'Wiek głosu'])
			->addText('timbre', ['label' => 'Barwa'])
			->addText('price', ['label' => 'Grupa cenowa'])
			->addText('style', ['label' => 'Styl interpretacji'])
			->endRepeater()

			/*--- USTAWIENIA BLOKU ---*/

			->addTab('Ustawienia bloku', ['placement' => 'top'])
			->addText('section_id', [
				'label' => 'ID',
			])
			->addText('section_class', [
				'label' => 'Dodatkowe klasy CSS',
			])
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
                ],
                'default_value' => 'none',
                'ui' => 0,
                'allow_null' => 0,
            ]);

		return $voices;
	}

	public function with(): array
	{
		$fields = [
			'g_voices' => get_field('g_voices'),
			'r_voices' => get_field('r_voices'),

			'section_id' => get_field('section_id'),
			'section_class' => get_field('section_class'),

			'flip' => (bool) get_field('flip'),
			'wide' => (bool) get_field('wide'),
			'nomt' => (bool) get_field('nomt'),
			'gap' => (bool) get_field('gap'),

			'background' => get_field('background') ?: 'none',
		];

		$fields['sectionClass'] = SectionClasses::fromMap($fields, [
			'flip' => 'order-flip',
			'wide' => 'wide',
			'nomt' => '!mt-0',
			'gap' => 'wider-gap',
		]);

		$voices = get_field('voices') ?: [];

		$filters = [
			'gender' => [],
			'age'    => [],
			'timbre' => [],
			'price'  => [],
			'style'  => [],
		];

		foreach ($voices as $voice) {
			foreach (array_keys($filters) as $key) {
				if (!empty($voice[$key])) {
					$filters[$key][] = ucfirst(trim($voice[$key]));
				}
			}
		}

		foreach ($filters as $key => $values) {
			$filters[$key] = array_values(array_unique($values));
		}

		$fields['voices']  = $voices;
		$fields['filters'] = $filters;

		return $fields;
	}
}

    public function fields()
    {
        $voices = new FieldsBuilder('voices');

        $voices
            ->setLocation('block', '==', 'acf/voices')
            ->addText('block-title', [
                'label' => 'Tytuł bloku',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Lektorzy - Katalog',
                'open' => true,
                'multi_expand' => true,
            ])
            /*--- FIELDS ---*/
            ->addTab('Treści', ['placement' => 'top'])
            ->addGroup('voices_settings', ['label' => ''])

            ->addText('title', ['label' => 'Tytuł'])
            ->addTextarea('text', [
                'label' => 'Opis',
                'rows' => 2,
                'new_lines' => 'br',
            ])
            ->addRelationship('selected_voices', [
                'label' => 'Wybierz głosy lektorów',
                'post_type' => ['voices'],
                'filters' => ['search', 'taxonomy'],
                'return_format' => 'object', 
            ])
            ->addTrueFalse('show_image', [
                'label' => 'Pokaż obrazek',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])
            ->addTrueFalse('show_excerpt', [
                'label' => 'Pokaż fragment treści',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Tak',
                'ui_off_text' => 'Nie',
            ])

            ->endGroup()

            /*--- USTAWIENIA BLOKU ---*/

            ->addTab('Ustawienia bloku', ['placement' => 'top'])
            ->addText('section_id', [
                'label' => 'ID',
            ])
            ->addText('section_class', [
                'label' => 'Dodatkowe klasy CSS',
            ])
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
                    'section-soft-blue' => 'Jasnoniebieskie (#F4F9FF)',
                    'section-lighter-grad' => 'Gradient Pionowy (Lighter)',
                    'section-light-horizontal' => 'Gradient Poziomy',
                ],
                'default_value' => 'none',
                'ui' => 0,
                'allow_null' => 0,
            ]);

        return $voices;
    }

    public function with(): array
    {
        $voices_settings = get_field('voices_settings') ?: [];
        $show_image = array_key_exists('show_image', $voices_settings) ? (bool) $voices_settings['show_image'] : true;
        $show_excerpt = array_key_exists('show_excerpt', $voices_settings) ? (bool) $voices_settings['show_excerpt'] : false;

        $selected_voices = $voices_settings['selected_voices'] ?? [];

        if (!empty($selected_voices)) {
            $posts = $selected_voices;
        } else {
            $args = [
                'post_type' => 'voices',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            ];

            $query = new \WP_Query($args);
            $posts = $query->posts;
        }

        $fields = [
            'voices_settings' => $voices_settings,
            'posts' => $posts, 
            'show_image' => $show_image,
            'show_excerpt' => $show_excerpt,
            'section_id' => get_field('section_id'),
            'section_class' => get_field('section_class'),
            'flip' => (bool) get_field('flip'),
            'wide' => (bool) get_field('wide'),
            'nomt' => (bool) get_field('nomt'),
            'gap' => (bool) get_field('gap'),
            'lightbg' => get_field('lightbg'),
            'graybg' => get_field('graybg'),
            'whitebg' => get_field('whitebg'),
            'brandbg' => get_field('brandbg'),
            'background' => get_field('background') ?: 'none',
        ];

        $fields['sectionClass'] = SectionClasses::fromMap($fields, [
            'flip' => 'order-flip',
            'wide' => 'wide',
            'nomt' => '!mt-0',
            'gap' => 'wider-gap',
        ]);

        return $fields;
    }
}