<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use App\Blocks\ExampleBlock;
use StoutLogic\AcfBuilder\FieldsBuilder;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        add_action('acf/init', function () {
            if (!function_exists('acf_add_options_page')) {
                return;
            }

            acf_add_options_page([
                'page_title' => 'Ustawienia motywu',
                'menu_title' => 'Ustawienia motywu',
                'menu_slug'  => 'theme-settings',
                'capability' => 'edit_posts',
                'redirect'   => false,
            ]);

            acf_add_options_page([
                'page_title' => 'Wezwanie do działania',
                'menu_title' => 'Wezwanie do działania',
                'menu_slug'  => 'bottom',
                'capability' => 'edit_posts',
                'redirect'   => false,
            ]);

            $headerFields = new FieldsBuilder('header_social_settings');
            
            $headerFields
                ->setLocation('options_page', '==', 'theme-settings')
                ->addRepeater('social_media', [
<<<<<<< Updated upstream
                    'label' => 'Social Media',
=======
                    'label' => 'Social Media (Nagłówek)',
>>>>>>> Stashed changes
                    'layout' => 'table',
                    'button_label' => 'Dodaj ikonę',
                ])
                    ->addSelect('icon', [
                        'label' => 'Wybierz serwis',
                        'choices' => [
                            'facebook' => 'Facebook',
                            'instagram' => 'Instagram',
                        ],
                        'default_value' => 'facebook',
                    ])
                    ->addLink('link', [
                        'label' => 'Link do profilu',
                        'return_format' => 'array',
                    ])
                ->endRepeater();

            acf_add_local_field_group($headerFields->build());
        });
    }
}