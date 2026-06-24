<?php

namespace App\Options;

use Log1x\AcfComposer\Options;
use StoutLogic\AcfBuilder\FieldsBuilder;
use App\Support\SectionClasses;

class ContactInfoOptions extends Options
{
    // Nazwa widoczna w menu WP
    public $name = 'Dane Kontaktowe'; 
    public $slug = 'contact-info-options'; 
    public $title = ' Dane Kontaktowe ';
    public $capability = 'edit_posts';
    public $redirect = false;
	public $position = 82;

    public function fields(): array
    {
        $contactInfoOptions = new FieldsBuilder('contact_info_options');

        $contactInfoOptions
            ->addTab('Dane Kontaktowe', ['placement' => 'top'])

            ->addGroup('g_contact_info', [
                'label' => ' Dane Kontaktowe ',
            ])
                ->addImage('image', [
                    'label' => 'Logo',
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                ])
                ->addText('phone', [
                    'label' => 'Numer Telefonu',
                ])
				 ->addText('phone2', [
                    'label' => 'Numer Telefonu 2',
                ])
				->addText('mail', [
                    'label' => 'e-mail',
                ])
              
            ->endGroup();
	

        return $contactInfoOptions->build();
    }
}