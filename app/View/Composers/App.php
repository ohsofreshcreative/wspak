<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class App extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        '*',
    ];

    /**
     * Dane dostępne we wszystkich widokach Blade.
     */
    public function with(): array
    {
        $rawLogo = get_field('logo', 'option');
        $logo = is_array($rawLogo)
            ? $rawLogo
            : ($rawLogo ? ['url' => $rawLogo, 'alt' => ''] : null);

        $rawLogoFooter = get_field('logo_footer', 'option');
        $logo_footer = is_array($rawLogoFooter)
            ? $rawLogoFooter
            : ($rawLogoFooter ? ['url' => $rawLogoFooter, 'alt' => ''] : null);

        return [
            'siteName'     => $this->siteName(),
            'logo'         => $logo,
            'logo_footer'  => $logo_footer,
            'social_media' => get_field('social_media', 'option') ?: [],
        ];
    }

    /**
     * Zwraca nazwę strony.
     */
    public function siteName(): string
    {
        return get_bloginfo('name', 'display');
    }
}