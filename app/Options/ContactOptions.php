<?php

namespace App\Options;

use Log1x\AcfComposer\Options;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ContactOptions extends Options
{
    public $name = 'Kontakt globalny'; 
    public $slug = 'contact-options'; 
    public $title = 'Kontakt globalny';
    public $capability = 'edit_posts';
    public $redirect = false;
    public $position = 83;

    public function fields(): array
    {
        $contactOptions = new FieldsBuilder('contact_options');

        $contactOptions
            /*--- TAB #1: DANE ---*/
			            ->setLocation('options_page', '==', 'contact-options')

            ->addTab('Dane kontaktowe', ['placement' => 'top'])
            ->addGroup('g_contact_1', ['label' => 'Dane główne'])
                ->addText('header', ['label' => 'Tytuł'])
                ->addTextarea('text', [
                    'label' => 'Opis',
                    'rows' => 3,
                    'new_lines' => 'br',
                ])
                ->addText('phone', ['label' => 'Numer telefonu'])
                ->addText('phone2', ['label' => 'Numer telefonu #2'])
                ->addText('mail', ['label' => 'Adres e-mail'])
            ->endGroup()

            /*--- TAB #2: FORMULARZ ---*/
            ->addTab('Formularz', ['placement' => 'top'])
            ->addGroup('g_contact_2', ['label' => 'Ustawienia formularza'])
                ->addText('title', ['label' => 'Tytuł nad formularzem'])
                ->addText('shortcode', [
                    'label' => 'Kod formularza',
                    'instructions' => 'Wklej kod formularza z Contact Form 7',
                    'default_value' => '[contact-form-7 id="f12c470" title="Formularz kontaktowy"]',
                ])
            ->endGroup();

        return $contactOptions->build();
    }
}