<?php

namespace App\Blocks;

use Log1x\AcfComposer\Block;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class Portfolio extends Block
{
	public $name = 'Portfolio Realizacji';
	public $description = 'Portfolio - kafelki z realizacjami i odtwarzaczem';
	public $slug = 'portfolio';
	public $category = 'formatting';
	public $icon = 'portfolio';
	public $keywords = ['portfolio', 'audiobooki', 'realizacje', 'nagrania'];
	public $mode = 'edit';
	public $supports = [
		'align' => false,
		'mode' => false,
		'jsx' => true,
	];

	public function fields()
	{
		$portfolio = new FieldsBuilder('portfolio');

		$portfolio
			->setLocation('block', '==', 'acf/portfolio')
			->addText('block-title', [
				'label' => 'Tytuł',
				'required' => 0,
			])
			->addAccordion('accordion1', [
				'label' => 'Portfolio realizacji',
				'open' => false,
				'multi_expand' => true,
			])

			->addTab('Realizacje', ['placement' => 'top'])
			->addRepeater('items', [
				'label' => 'Realizacje',
				'layout' => 'row',
				'pagination' => 1,
				'rows_per_page' => 10,
				'button_label' => 'Dodaj realizację',
			])
			->addImage('cover', [
				'label' => 'Okładka / Zdjęcie',
				'return_format' => 'url',
				'preview_size' => 'thumbnail',
			])
			->addText('title', ['label' => 'Tytuł'])
			->addText('author', ['label' => 'Autor'])
			->addText('reader', ['label' => 'Czyta'])
			->addText('publisher', ['label' => 'Wydawca'])
			->addText('badge', ['label' => 'Etykieta'])
			->addFile('audio_file', [
				'label' => 'Plik audio',
				'return_format' => 'url',
				'mime_types' => 'mp3,wav,ogg',
				'required' => 1,
			])
			->endRepeater()
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
				],
				'default_value' => 'none',
				'ui' => 0,
				'allow_null' => 0,
			]);

		return $portfolio;
	}

	public function with(): array
	{
		$fields = [
			'title'         => get_field('block-title'),
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

		$fields['items'] = get_field('items') ?: [];

		return $fields;
	}
}
