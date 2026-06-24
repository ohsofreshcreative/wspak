<?php

/*--- CPT - Produkty ---*/

add_action('init', function () {
    register_post_type('product', [
        'label'         => 'Produkty',
        'labels'        => [
            'name'               => 'Produkty',
            'singular_name'      => 'Produkt',
            'menu_name'          => 'Produkty',
            'all_items'          => 'Wszystkie produkty',
            'add_new'            => 'Dodaj nowy',
            'add_new_item'       => 'Dodaj nowy produkt',
            'edit_item'          => 'Edytuj produkt',
            'new_item'           => 'Nowy produkt',
            'view_item'          => 'Zobacz produkt',
            'view_items'         => 'Zobacz produkty',
            'search_items'       => 'Szukaj produktów',
            'not_found'          => 'Nie znaleziono produktów',
            'not_found_in_trash' => 'Brak produktów w koszu',
            'parent_item_colon'  => 'Produkt nadrzędny:',
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-cart',
        'menu_position' => 20,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'produkty', 'with_front' => false],
    ]);
});

add_action('init', function () {
    register_taxonomy('product_category', ['product'], [
        'label'        => 'Kategorie produktów',
        'labels'       => [
            'name'              => 'Kategorie produktów',
            'singular_name'     => 'Kategoria produktu',
            'search_items'      => 'Szukaj kategorii',
            'all_items'         => 'Wszystkie kategorie',
            'parent_item'       => 'Kategoria nadrzędna',
            'parent_item_colon' => 'Kategoria nadrzędna:',
            'edit_item'         => 'Edytuj kategorię',
            'update_item'       => 'Aktualizuj kategorię',
            'add_new_item'      => 'Dodaj nową kategorię',
            'new_item_name'     => 'Nazwa nowej kategorii',
            'menu_name'         => 'Kategorie',
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'kategoria-produktu', 'with_front' => false],
    ]);
});

/*--- CPT - Nasza Oferta ---*/

add_action('init', function () {
    register_post_type('offers', [
        'label'         => 'Nasza Oferta',
        'labels'        => [
            'name'               => 'Nasza Oferta',
            'singular_name'      => 'offer',
            'menu_name'          => 'Nasza Oferta',
            'name_admin_bar'     => 'offer',
            'add_new'            => 'Dodaj nowy',
            'add_new_item'       => 'Dodaj nową ofertę',
            'new_item'           => 'Nowa oferta',
            'edit_item'          => 'Edytuj ofertę',
            'view_item'          => 'Zobacz ofertę',
            'all_items'          => 'Wszystkie oferty',
            'search_items'       => 'Szukaj oferty',
            'parent_item_colon'  => 'Rodzic:',
            'not_found'          => 'Nie znaleziono oferty.',
            'not_found_in_trash' => 'Brak ofert w koszu.'
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-warning',
        'menu_position' => 20,
        'supports'      => ['title', 'editor', 'thumbnail', 'excerpt'],
        'taxonomies'    => ['offer_category'],
        'show_in_rest'  => true,
        'rewrite'       => ['slug' => 'oferty', 'with_front' => false],
    ]); 
});

add_action('init', function () {
    register_taxonomy('offer_category', ['offers'], [
        'label'        => 'Kategorie ofert',
        'labels'       => [
            'name'              => 'Kategorie ofert',
            'singular_name'     => 'Kategoria ofert',
            'search_items'      => 'Szukaj kategorii',
            'all_items'         => 'Wszystkie kategorie',
            'parent_item'       => 'Kategoria nadrzędna',
            'parent_item_colon' => 'Kategoria nadrzędna:',
            'edit_item'         => 'Edytuj kategorię',
            'update_item'       => 'Aktualizuj kategorię',
            'add_new_item'      => 'Dodaj nową kategorię',
            'new_item_name'     => 'Nazwa nowej kategorii',
            'menu_name'         => 'Kategorie',
        ],
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
        'rewrite'      => ['slug' => 'kategoria-ofert', 'with_front' => false],
    ]);
});

/*--- REJESTRACJA POLA DLA IKONY W PRAWYM PANELU BOCZNYM ---*/
add_action('acf/init', function() {
    $offer_side_fields = new \StoutLogic\AcfBuilder\FieldsBuilder('oferta_panel_boczny', [
        'title' => 'Ustawienia kafelka oferty',
        'position' => 'side', 
        'style' => 'default',
        'label_placement' => 'top',
    ]);
    
    $offer_side_fields
        ->setLocation('post_type', '==', 'offers')
        ->addImage('offer_icon', [
            'label' => 'Ikona',
            'instruction' => 'Wybierz ikonę ',
            'return_format' => 'id', 
            'preview_size' => 'thumbnail',
        ]);

    acf_add_local_field_group($offer_side_fields->build());
});