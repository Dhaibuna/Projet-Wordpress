<?php

// LES ADD ACTION

//On ajoute une action pour détecter l’initialisation. Tu ouvres ta fonction, tu la ferme et puis tu la lances. En résumé, tu dois sortir l'appel de la fonction. L'appel qui est " add_action ". " Tu déclares ta fonction et puis tu l'appelle ".
add_action('init', 'on_wimfi_init');

//Une fois cette fonction lancée, le menu dans le dashboard de Wordpress sera créé. Il faudra alors publier les pages de votre blog dans l'onglet pages.
add_action('wp_nav_menu', 'wimfi_menu_responsive', 9, 2); // les menus

// Styles
add_action('wp_enqueue_scripts', 'wimfi_styles_scripts');

add_action('wp_enqueue_scripts', 'add_google_font');

// Gestion dynamique du titre par WP
add_theme_support('title-tag');

// Autorisation du champ " image en avant / featured image"
add_theme_support('post-thumbnails');

add_action('init', 'wimfi_custom_post_type', 0);

add_filter('excerpt_length', 'new_excerpt_length');


// LES FONCTIONS

function on_wimfi_init()
{
  //on enregistre le menu
  register_nav_menu('header_menu', 'Header Menu');
  // Register Custom Post Type

  // On enregistre la taxonomie de la gallerie
  register_taxonomy('media_category', 'attachment', $args);

  //Le tableau de la taxonomie perosnnalisée
  $labels = array(
    'name' => __('Media categories', 'wimfi'),
    'singular_name' => __('Media category', 'wimfi'),
    'search_items' => __(' Search Media categories', 'wimfi'),
    'all_items' => __('All Media categories', 'wimfi'),
    'parent_item' => __('Parent Media category', 'wimfi'),
    'parent_item_colon' => __('Parent Media category', 'wimfi'),
    'edit_item' => __('Edit Media category', 'wimfi'),
    'update_item' => __('Update Media category', 'wimfi'),
    'add_new_item' => __('Add New edia category', 'wimfi'),
    'new_item_name' => __('New edia category Name', 'wimfi'),
    'menu_name' => __('Media categories', 'wimfi'),
  );

  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
    'query_var' => true,
    'rewrite' > true,
    'show_admin_column' => true,
    'show_ui' => true,

    'update_count_callback' => '_update_generic_term_count',
  );

  register_taxonomy('media_category', 'attachment', $args);
  register_taxonomy_for_object_type('media_category', 'attachment');

  // Ajout d'une page d'option pour gérer l'affichage du footer

  if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
      'page_title' => 'Theme General Settings',
      'menu_title' => 'Theme Settings',
      'menu_slug' => 'theme-general-settings',
      'capability' => 'edit_posts',
      'redirect' => false
    ));
    acf_add_options_sub_page(array(
      'page_title' => 'Theme Header Settings',
      'menu_title' => 'Header',
      'parent_slug' => 'theme-general-settings',
    ));
    acf_add_options_sub_page(array(
      'page_title' => 'Theme Footer Settings',
      'menu_title' => 'Footer',
      'parent_slug' => 'theme-general-settings',
    ));
  }
}

// Fonction responsive

function wimfi_menu_responsive($menu, $args)
{
  if ('header_menu' == $args->theme_location) {
    $button = '  <nav class="main-navigation">
    <button type="button" class="toggle-menu">
      <i class="fa fa-bars"></i>
    </button>';
    $menu = preg_replace('/(<nav(.*?)>)/', '${1}' . $button, $menu);
  }
  return $menu;
}

// Fonction allant rechercher les styles

function wimfi_styles_scripts()
{
  // wp_enqueue_style ajoute le css dans la page
  wp_register_style('wimfi-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_style('wimfi-style');

  // Ajout des fonts
  wp_register_style('wimfi-fonts', get_template_directory_uri() . './fonts/font-awesome.min.css');
  wp_enqueue_style('wimfi-fonts');



  // Ajout des scripts
  wp_register_script(
    'wimfi-plugins',
    get_template_directory_uri() . '/js/plugins.js',
    array('jquery')
  );
  wp_register_script('wimfi-app', get_template_directory_uri() . '/js/app.js', array('jquery', 'wimfi-plugins'));

  wp_enqueue_script('wimfi-plugins');
  wp_enqueue_script('wimfi-app');

  //Add js only for IE9
  wp_script_add_data('ie-support-html5', 'conditional', 'lt IE 9');
  wp_script_add_data('ie-support-respond', 'conditional', 'lt IE 9');
}
// Ajout de la google font

function add_google_font()
{
  wp_enqueue_style('google-font', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900');
}

// Génération du Custom post
function wimfi_custom_post_type()
{

  $labels = array(
    'name'                  => _x('Albums', 'Post Type General Name', 'wimfi'),
    'singular_name'         => _x('Album', 'Post Type Singular Name', 'wimfi'),
    'menu_name'             => __('Albums', 'wimfi'),
    'name_admin_bar'        => __('Album', 'wimfi'),
    'archives'              => __('Album Archives', 'wimfi'),
    'attributes'            => __('Album attributes', 'wimfi'),
    'parent_item_colon'     => __('Parent Album', 'wimfi'),
    'all_items'             => __('All Items', 'wimfi'),
    'add_new_item'          => __('Add New Item', 'wimfi'),
    'add_new'               => __('Add New', 'wimfi'),
    'new_item'              => __('New Album', 'wimfi'),
    'edit_item'             => __('Edit Album', 'wimfi'),
    'update_item'           => __('Update Album', 'wimfi'),
    'view_item'             => __('View Album', 'wimfi'),
    'view_items'            => __('View Albums', 'wimfi'),
    'search_items'          => __('Search Album', 'wimfi'),
    'not_found'             => __('Not found', 'wimfi'),
    'not_found_in_trash'    => __('Not found in Trash', 'wimfi'),
    'featured_image'        => __('Featured Image', 'wimfi'),
    'set_featured_image'    => __('Set featured image', 'wimfi'),
    'remove_featured_image' => __('Remove featured image', 'wimfi'),
    'use_featured_image'    => __('Use as featured image', 'wimfi'),
    'insert_into_item'      => __('Insert into item', 'wimfi'),
    'uploaded_to_this_item' => __('Uploaded to this Album', 'wimfi'),
    'items_list'            => __('Albums list', 'wimfi'),
    'items_list_navigation' => __('Albums list navigation', 'wimfi'),
    'filter_items_list'     => __('Filter albums list', 'wimfi'),

  );
  $args = array(
    'label'                 => __('Album', 'wimfi'),
    'description'           => __('Discographie de wimfi records', 'wimfi'),
    'labels'                => $labels,
    'supports'              => array('title', 'editor', 'thumbnail', 'excerpt'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    'menu_icon'             => 'dashicons-format-audio',
  );
  register_post_type('album', $args);
}


// Register  Event Custom Post Type for front_page
// Register Custom Post Type
function event_custom_post_type()
{

  $labels = array(
    'name'                  => _x('Events', 'Post Type General Name', 'wimfi'),
    'singular_name'         => _x('Event', 'Post Type Singular Name', 'wimfi'),
    'menu_name'             => __('Events', 'wimfi'),
    'name_admin_bar'        => __('Event', 'wimfi'),
    'archives'              => __('Event Archives', 'wimfi'),
    'attributes'            => __('Event Attributes', 'wimfi'),
    'parent_item_colon'     => __('Parent Event', 'wimfi'),
    'all_items'             => __('All events', 'wimfi'),
    'add_new_item'          => __('Add New event', 'wimfi'),
    'add_new'               => __('Add New', 'wimfi'),
    'new_item'              => __('New Event', 'wimfi'),
    'edit_item'             => __('Edit Event', 'wimfi'),
    'update_item'           => __('Update Item', 'wimfi'),
    'view_item'             => __('View Event', 'wimfi'),
    'view_items'            => __('View Events', 'wimfi'),
    'search_items'          => __('Search Event', 'wimfi'),
    'not_found'             => __('Not found', 'wimfi'),
    'not_found_in_trash'    => __('Not found in Trash', 'wimfi'),
    'featured_image'        => __('Featured Image', 'wimfi'),
    'set_featured_image'    => __('Set featured image', 'wimfi'),
    'remove_featured_image' => __('Remove featured image', 'wimfi'),
    'use_featured_image'    => __('Use as featured image', 'wimfi'),
    'insert_into_item'      => __('Insert into event', 'wimfi'),
    'uploaded_to_this_item' => __('Uploaded to this event', 'wimfi'),
    'items_list'            => __('Events list', 'wimfi'),
    'items_list_navigation' => __('Events list navigation', 'wimfi'),
    'filter_items_list'     => __('Filter events list', 'wimfi'),
  );
  $args = array(
    'label'                 => __('Event', 'wimfi'),
    'description'           => __('Events of wimfi records', 'wimfi'),
    'labels'                => $labels,
    'supports'              => array('title', 'editor', 'excerpt'),
    'taxonomies'            => array('category', 'post_tag'),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'page',
    'menu_icon'             => 'dashicons-calendar-alt',
  );
  register_post_type('event', $args);
}


// Fonction limitant la taille de l'excerpt, je choisis 50 caractères

function new_excerpt_length($length)
{
  return 25;
}