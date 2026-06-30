<?php
namespace App\Options;
use Log1x\AcfComposer\Options;
use StoutLogic\AcfBuilder\FieldsBuilder;

class DuotitleOptions extends Options
{
    public $name = 'Sekcja - Bank głosów'; 
    public $slug = 'duotitle-options'; 
    public $title = 'Sekcja Bank głosów';
    public $capability = 'edit_posts';
    public $redirect = false;
    public $position = 84;

    public function fields(): array
    {
        $DuotitleOptions = new FieldsBuilder('duotitle_options');

        $DuotitleOptions
            ->setLocation('options_page', '==', 'duotitle-options') 
            ->addText('block-title', [
                'label' => 'Tytuł strony w panelu',
                'required' => 0,
            ])
            ->addAccordion('accordion1', [
                'label' => 'Tekst oraz zdjęcie',
                'open' => true,
                'multi_expand' => true,
            ])
            ->addTab('Elementy', ['placement' => 'top'])
            ->addGroup('g_duotitle', ['label' => 'Zawartość sekcji'])
                ->addImage('image', [
                    'label' => 'Obraz',
                    'return_format' => 'array',
                    'preview_size' => 'thumbnail',
                ])
                ->addText('header_small', ['label' => 'Mały nagłówek'])
                ->addText('header', ['label' => 'Nagłówek'])
                ->addWysiwyg('text', [
                    'label' => 'Treść',
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => true,
                ])
                ->addLink('button1', [
                    'label' => 'Przycisk #1',
                    'return_format' => 'array',
                ])
                ->addLink('button2', [
                    'label' => 'Przycisk #2',
                    'return_format' => 'array',
                ])
                ->addText('title_number', [
                    'label' => 'Liczba (np. 50+)',
                ])
                ->addText('text_number', [
                    'label' => 'Tekst do liczby',
                ])
            ->endGroup()
	->addTab('Głosy', ['placement' => 'top'])
            ->addRepeater('voices', [
                'label' => 'Głosy',
                'layout' => 'row',
                'pagination' => 1,
                'rows_per_page' => 10,
                'button_label' => 'Dodaj głos',
            ])
                ->addImage('avatar', [
                    'label' => 'Zdjęcie / Avatar',
                    'return_format' => 'url',
                    'preview_size' => 'thumbnail',
                ])
                ->addRepeater('audio_tracks', [
                    'label' => 'Pliki audio',
                    'layout' => 'table',
                    'button_label' => 'Dodaj nagranie',
                    'min' => 1,
                ])
                    ->addFile('file', [
                        'label' => 'Plik audio',
                        'return_format' => 'url',
                        'mime_types' => 'mp3,wav,ogg',
                        'required' => 1,
                    ])
                ->endRepeater()
                ->addText('name', ['label' => 'Imię Lektora'])
                ->addText('gender', ['label' => 'Płeć'])
                ->addText('age', ['label' => 'Wiek głosu'])
                ->addText('timbre', ['label' => 'Barwa'])
                ->addText('price', ['label' => 'Grupa cenowa'])
                ->addText('style', ['label' => 'Styl interpretacji'])
            ->endRepeater();
        return $DuotitleOptions->build();
    }
}