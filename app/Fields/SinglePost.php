<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class SinglePost extends Field
{
    /**
     * Definiuje grupę pól dla pojedynczego wpisu blogowego.
     * Na podstawie tej definicji pola pokażą się automatycznie w kokpicie WordPressa.
     *
     * @return array
     */
    public function fields(): array
    {
        $singlePost = new FieldsBuilder('single_post_fields', [
            'title' => 'Boks CTA we wpisie',
            'style' => 'default',
            'position' => 'side', 
        ]);

        $singlePost
            ->setLocation('post_type', '==', 'post');

        $singlePost
            ->addGroup('cta_box', [
                'label' => 'Boks reklamowy (CTA)',
                'layout' => 'block',
            ])
                ->addTrueFalse('show', [
                    'label' => 'Pokaż boks CTA?',
                    'instructions' => 'Zaznacz, aby boks reklamowy pojawił się na stronie wpisu.',
                    'ui' => 1,
                    'ui_on_text' => 'Tak',
                    'ui_off_text' => 'Nie',
                    'default_value' => 0,
                ])
                ->addImage('image', [
                    'label' => 'Obraz tła',
                    'instructions' => 'Wybierz obrazek, który będzie tłem boksu.',
                    'return_format' => 'id', 
                    'preview_size' => 'medium',
                ])
                ->addText('title', [
                    'label' => 'Nagłówek',
                    'instructions' => 'Wpisz nagłówek wyświetlany na boksie.',
                ])
                ->addLink('button', [
                    'label' => 'Przycisk',
                    'instructions' => 'Wybierz link i tekst przycisku.',
                    'return_format' => 'array', 
                ])
            ->endGroup();

        return [$singlePost];
    }
}
