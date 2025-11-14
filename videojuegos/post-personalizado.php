<?php
/*
Plugin Name: Videojuegos Personalizados
Description: Añade un tipo de contenido personalizado "Videojuegos" con categorías, imagen destacada, enlaces y video usando ACF.
Version: 1.2.0
Author: Gael
*/

if (!defined('ABSPATH')) die();

// 🔹 Registrar el Custom Post Type
function raycothemess_videojuegos_post_type() {

    $labels = array(
        'name'                  => _x('Videojuegos', 'Post Type General Name', 'raycothemess'),
        'singular_name'         => _x('Videojuego', 'Post Type Singular Name', 'raycothemess'),
        'menu_name'             => __('Videojuegos', 'raycothemess'),
        'add_new_item'          => __('Agregar Videojuego', 'raycothemess'),
        'edit_item'             => __('Editar Videojuego', 'raycothemess'),
        'new_item'              => __('Nuevo Videojuego', 'raycothemess'),
        'view_item'             => __('Ver Videojuego', 'raycothemess'),
        'search_items'          => __('Buscar Videojuegos', 'raycothemess'),
        'not_found'             => __('No se encontraron videojuegos', 'raycothemess'),
        'not_found_in_trash'    => __('No hay videojuegos en la papelera', 'raycothemess'),
    );

    $args = array(
        'label'                 => __('Videojuegos', 'raycothemess'),
        'description'           => __('Catálogo de videojuegos', 'raycothemess'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'comments'),
        'taxonomies'            => array('categorias_videojuegos'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 6,
        'menu_icon'             => 'dashicons-games',
        'has_archive'           => true,
        'show_in_rest'          => true, 
    );

    register_post_type('videojuegos', $args);
}
add_action('init', 'raycothemess_videojuegos_post_type', 0);

// 🔹 Registrar las categorías personalizadas
function raycothemess_videojuegos_taxonomy() {
    $labels = array(
        'name'              => _x('Categorías', 'taxonomy general name'),
        'singular_name'     => _x('Categoría', 'taxonomy singular name'),
        'search_items'      => __('Buscar Categorías'),
        'all_items'         => __('Todas las Categorías'),
        'edit_item'         => __('Editar Categoría'),
        'update_item'       => __('Actualizar Categoría'),
        'add_new_item'      => __('Agregar Nueva Categoría'),
        'new_item_name'     => __('Nuevo Nombre de Categoría'),
        'menu_name'         => __('Categorías'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-videojuego'),
    );

    register_taxonomy('categorias_videojuegos', array('videojuegos'), $args);
}
add_action('init', 'raycothemess_videojuegos_taxonomy', 1);

// 🔹 Meta boxes para enlaces (manteniendo los dos enlaces, opcional)
function raycothemess_add_enlaces_meta_boxes() {
    add_meta_box('videojuego_enlaces', 'Enlaces del Juego', 'raycothemess_enlaces_callback', 'videojuegos', 'normal', 'high');
}
add_action('add_meta_boxes', 'raycothemess_add_enlaces_meta_boxes');

function raycothemess_enlaces_callback($post) {
    $link1 = get_post_meta($post->ID, '_link1', true);
    $link2 = get_post_meta($post->ID, '_link2', true);
    ?>
    <p><label for="link1">Enlace 1:</label><br>
    <input type="url" id="link1" name="link1" value="<?php echo esc_attr($link1); ?>" style="width:100%;"></p>

    <p><label for="link2">Enlace 2:</label><br>
    <input type="url" id="link2" name="link2" value="<?php echo esc_attr($link2); ?>" style="width:100%;"></p>
    <?php
}

// Guardar enlaces
function raycothemess_save_meta($post_id) {
    if (isset($_POST['link1']))
        update_post_meta($post_id, '_link1', sanitize_text_field($_POST['link1']));
    if (isset($_POST['link2']))
        update_post_meta($post_id, '_link2', sanitize_text_field($_POST['link2']));
}
add_action('save_post', 'raycothemess_save_meta');

// 🔹 ACF: Para el gameplay video ya no necesitamos meta box ni save, solo crea un campo ACF llamado "gameplay_video"
// Ejemplo para mostrar en plantilla:
function raycothemess_mostrar_video($post_id) {
    $video = get_field('gameplay_video', $post_id);
    if ($video) {
        echo '<iframe width="560" height="315" src="' . esc_url($video) . '" frameborder="0" allowfullscreen></iframe>';
    }
}

// 🔹 Habilitar imágenes destacadas en el tema (poner en functions.php de tu tema)
function raycothemess_theme_setup() {
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'raycothemess_theme_setup');
