<?php

/**
 * autoloading avec composer
 */

require get_template_directory() . '/vendor/autoload.php';

/**
 * wp-bootstrap/wp-bootstrap-navwalker
 */

require get_template_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

/**
 * sécurité
 */

// désactive l'édition de fichier dans l'admin
define( 'DISALLOW_FILE_EDIT', true );

/**
 * localisation
 */

// choix du fuseau horaire
date_default_timezone_set( 'Europe/Paris' );
// choix du réglage régional
setlocale( LC_ALL, 'fr', 'fr_FR', 'fr_FR.utf8', 'fr_FR.ISO_8859-1' );

/**
 * CSS
 */

// cette fonction se charge d'intégrer les feuilles de style du thème
function my_theme_enqueue_styles() {
    // affiche la liste des feuilles de style qui seront chargées
    // $wp_styles = wp_styles();
    // var_dump($wp_styles->queue);
    // affiche des infos détaillées sur chaque feuille de style
    // foreach( $wp_styles->queue as $handle ) {
    //     var_dump($wp_styles->registered[$handle]);
    // }

    // chargement de la feuille de style de Bootstrap
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' );
    // chargement de la feuille de style du thème
    wp_enqueue_style( 'my-theme-main', get_stylesheet_directory_uri().'/css/main.css', ['bootstrap'] );
}

// demande à Wordpress de lancer la fonction `my_theme_enqueue_styles` durant le démarrage de l'application
// PHP_INT_MAX est le niveau de priorité, plus ce nombre est grand et moins la priorité est élevée
// le niveau de priorité par défaut est 10
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles', PHP_INT_MAX );

/**
 * JS
 */

// cette fonction se charge d'intégrer les scripts JS du thème
function my_theme_enqueue_scripts() {
    // affiche la liste des scripts qui seront chargées
    // $wp_scripts = wp_scripts();
    // var_dump($wp_scripts->queue);
    // affiche des infos détaillées sur chaque script
    // foreach( $wp_scripts->queue as $handle ) {
    //     var_dump($wp_scripts->registered[$handle]);
    // }

    // chargement du script JS de Popper (une dépendance de Bootstrap)
    wp_enqueue_script( 'popper', get_stylesheet_directory_uri().'/js/popper.min.js', ['jquery'] );
    // chargement du script JS de Bootstrap
    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri().'/js/bootstrap.min.js', ['popper'] );
    // chargement du script JS du thème
    wp_enqueue_script( 'my-theme-main', get_stylesheet_directory_uri().'/js/main.js', ['bootstrap'] );
}

// demande à Wordpress de lancer la fonction `my_theme_enqueue_scripts` durant le démarrage de l'application
// PHP_INT_MAX est le niveau de priorité, plus ce nombre est grand et moins la priorité est élevée
// le niveau de priorité par défaut est 10
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_scripts', PHP_INT_MAX );

/**
 * menu
 */

// déclaration des menus utilisés
register_nav_menus([
    // si vous changez le nom du menu, changez-le aussi dans la configuration du menu WP_Bootstrap_Navwalker dans le fichier `header.php`
    'main-menu' => 'Main menu',
]);

/**
 * fonctionnalités du thème
 */

// activation de la fonctionnalité des balises HTML5
add_theme_support( 'html5' );
// activation de la fonctionnalité du titre du site
add_theme_support( 'title-tag' );
// activation de la fonctionnalité des vignettes
add_theme_support( 'post-thumbnails' );

/**
 * résumés (excerpts)
 */

// cette fonction définit le nombre de mot maximal à afficher dans la résumé d'un article
function my_theme_excerpt_length( $length ) {
    // maximum de mots
    return 20;
}
add_filter( 'excerpt_length', 'my_theme_excerpt_length', 999 );

// cette fonction définit la chaîne de caractères qui est affiché quand le résumé d'un article est tronqué
function my_theme_excerpt_more( $more ) {
    // chaîne de caractères à afficher après un résumé tronqué
    return '&hellip;';
}
add_filter( 'excerpt_more', 'my_theme_excerpt_more' );

/**
 * vignettes (thumbnails)
 */

// tailles de vignettes définies par défaut
// thumbnail: 150, 150, ['center', 'center']
// medium: 300, 300
// medium_large: 768, 0
// large: 1024, 1024

// ajout de nouvelles tailles de vignettes
function my_theme_add_image_size() {
    add_image_size( 'my-thumbnail',  150, 150, ['center', 'center'] );
    add_image_size( 'my-medium',  300, 300 );
    add_image_size( 'my-medium_large',  768, 0 );
    add_image_size( 'my-large',  1024, 1024 );
}
add_action( 'after_setup_theme', 'my_theme_add_image_size' );

// rend les nouvelles tailles de vignettes sélectionnables dans l'admin
function my_theme_image_size_names_choose($sizes) {
    return array_merge( $sizes, [
        'my-thumbnail' => __( 'Taille des miniatures' ),
        'my-medium' => __( 'Taille moyenne' ),
        'my-medium-large' => __( 'Taille moyenne large' ),
        'my-large' => __( 'Grande taille' ),
    ]);
}
add_filter( 'image_size_names_choose', 'my_theme_image_size_names_choose' );

