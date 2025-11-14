<?php
// Mantener todas tus funciones existentes (romsps2_enqueue_styles, romsps2_setup, CPTs, Metaboxes, etc.)
function romsps2_enqueue_styles() {
    wp_enqueue_style('romsps2-style', get_stylesheet_uri());
    wp_enqueue_style('romsps2-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', array(), '6.5.0');
}
add_action('wp_enqueue_scripts', 'romsps2_enqueue_styles');

function romsps2_setup() {
    register_nav_menus(array(
        'primary' => 'Menú Principal',
    ));
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'romsps2_setup');

function romsps2_register_videojuegos_cpt() {
    $labels = array(
        'name' => 'Videojuegos',
        'singular_name' => 'Videojuego',
        'menu_name' => 'Videojuegos',
        'all_items' => 'Todos los Videojuegos',
        'add_new' => 'Añadir Nuevo',
        'add_new_item' => 'Añadir Nuevo Videojuego',
        'edit_item' => 'Editar Videojuego',
        'new_item' => 'Nuevo Videojuego',
        'view_item' => 'Ver Videojuego',
        'search_items' => 'Buscar Videojuegos',
        'not_found' => 'No se encontraron Videojuegos',
        'not_found_in_trash' => 'No se encontraron Videojuegos en la papelera',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'videojuegos'),
        'supports' => array('title', 'editor', 'thumbnail', 'comments'),
        'show_in_rest' => true,
    );

    register_post_type('videojuegos', $args);
}
add_action('init', 'romsps2_register_videojuegos_cpt');


function romsps2_mostrar_gameplay_video($post_id) {
    if (function_exists('get_field')) { 
        $video = get_field('gameplay_video', $post_id);
        if ($video) {
            echo '<div class="gameplay-video">';
            echo '<iframe width="560" height="315" src="' . esc_url($video) . '" frameborder="0" allowfullscreen></iframe>';
            echo '</div>';
        }
    }
}

function romsps2_register_comentarios_cpt() {

    $labels = array(
        'name'               => 'Comentarios',
        'singular_name'      => 'Comentario',
        'menu_name'          => 'Comentarios',
        'add_new'            => 'Añadir nuevo',
        'add_new_item'       => 'Añadir comentario',
        'edit_item'          => 'Editar comentario',
        'new_item'           => 'Nuevo comentario',
        'view_item'          => 'Ver comentario',
        'search_items'       => 'Buscar comentarios',
        'not_found'          => 'No hay comentarios',
        'not_found_in_trash' => 'No hay comentarios en la papelera',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'rewrite'            => array('slug' => 'comentarios'),
        'supports'           => array('title', 'thumbnail'),
        'menu_icon'          => 'dashicons-format-chat',
        'show_in_rest'       => true,
    );

    register_post_type('comentarios', $args);
}
add_action('init', 'romsps2_register_comentarios_cpt');
// Crear metabox
function romsps2_comentarios_metaboxes() {
    add_meta_box(
        'comentarios_meta',
        'Información del usuario',
        'romsps2_comentarios_meta_callback',
        'comentarios',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'romsps2_comentarios_metaboxes');

function romsps2_comentarios_meta_callback($post) {
    $nombre = get_post_meta($post->ID, 'nombre', true);
    $descripcion = get_post_meta($post->ID, 'descripcion', true);
    ?>

    <label><strong>Nombre:</strong></label>
    <input type="text" name="nombre" value="<?php echo esc_attr($nombre); ?>" 
        style="width:100%; margin-bottom:15px;">

    <label><strong>Descripción:</strong></label>
    <input type="text" name="descripcion" value="<?php echo esc_attr($descripcion); ?>" 
        style="width:100%;">

    <?php
}

// Guardar datos
function romsps2_save_comentarios_meta($post_id) {

    if (array_key_exists('nombre', $_POST)) {
        update_post_meta($post_id, 'nombre', sanitize_text_field($_POST['nombre']));
    }

    if (array_key_exists('descripcion', $_POST)) {
        update_post_meta($post_id, 'descripcion', sanitize_text_field($_POST['descripcion']));
    }
}
add_action('save_post', 'romsps2_save_comentarios_meta');


// =================================================================
// NUEVA FUNCIÓN DE PROCESAMIENTO DE CONTACTO (Añadir a functions.php)
// =================================================================

/**
 * Procesa el formulario de contacto enviado a través de admin-post.php.
 * Se encarga de la seguridad, sanitización, envío de correo y redirección.
 */
function romsps2_procesar_formulario_contacto() {

    // 1. VERIFICACIÓN DE SEGURIDAD (Nonce y Método)
    
    // Verifica el método de la petición
    if ( 'POST' !== $_SERVER['REQUEST_METHOD'] ) {
        wp_safe_redirect( home_url() );
        exit;
    }

    // Verifica el Nonce (el campo de seguridad que pusimos en el formulario)
    if ( ! isset( $_POST['romsps2_contact_nonce'] ) || ! wp_verify_nonce( $_POST['romsps2_contact_nonce'], 'romsps2_contact_form_action' ) ) {
        // Si la verificación falla, redirige con un mensaje de error de seguridad
        $url_error = add_query_arg( 'form_status', 'error_seguridad', wp_get_referer() );
        wp_safe_redirect( $url_error );
        exit;
    }
    
    // 2. RECOLECCIÓN Y SANITIZACIÓN DE DATOS

    $nombre = isset( $_POST['nombre'] ) ? sanitize_text_field( $_POST['nombre'] ) : '';
    $apellidos = isset( $_POST['apellidos'] ) ? sanitize_text_field( $_POST['apellidos'] ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( $_POST['email'] ) : '';
    $mensaje = isset( $_POST['mensaje'] ) ? sanitize_textarea_field( $_POST['mensaje'] ) : '';

    // Si falta información crítica, redirige con error de campos
    if ( empty( $nombre ) || empty( $email ) || empty( $mensaje ) ) {
        $url_error = add_query_arg( 'form_status', 'error_campos', wp_get_referer() );
        wp_safe_redirect( $url_error );
        exit;
    }

    // 3. ESTRUCTURA Y ENVÍO DEL CORREO

    $destinatario = get_option( 'admin_email' ); // Correo del administrador de WordPress
    $asunto = 'Nuevo Mensaje de Contacto (ROMSPS2) de ' . $nombre;
    
    $cuerpo_correo = "¡Has recibido un nuevo mensaje de contacto!\n\n";
    $cuerpo_correo .= "Nombre: " . $nombre . " " . $apellidos . "\n";
    $cuerpo_correo .= "Email: " . $email . "\n";
    $cuerpo_correo .= "Mensaje:\n" . $mensaje . "\n\n";

    // Cabeceras para que el email de respuesta sea el del usuario
    $cabeceras = array(
        'Reply-To: ' . $nombre . ' <' . $email . '>',
        'Content-Type: text/plain; charset=UTF-8'
    );
    
    // Intenta enviar el correo
    $enviado = wp_mail( $destinatario, $asunto, $cuerpo_correo, $cabeceras );


    // 4. REDIRECCIÓN Y FEEDBACK

    // Obtener la URL de la página de donde vino el envío (referrer)
    $referer_url = wp_get_referer() ? wp_get_referer() : home_url();

    if ( $enviado ) {
        // Éxito
        $url_exito = add_query_arg( 'form_status', 'success', $referer_url );
        wp_safe_redirect( $url_exito );
        exit;
    } else {
        // Error de envío
        $url_error = add_query_arg( 'form_status', 'error_envio', $referer_url );
        wp_safe_redirect( $url_error );
        exit;
    }
}


// Engancha la función al hook de procesamiento de formularios de WP
// CRÍTICO: El valor 'procesar_formulario_contacto' DEBE COINCIDIR con el campo action del formulario
add_action( 'admin_post_nopriv_procesar_formulario_contacto', 'romsps2_procesar_formulario_contacto' ); // Para usuarios NO logeados
add_action( 'admin_post_procesar_formulario_contacto', 'romsps2_procesar_formulario_contacto' );     // Para usuarios logeados

?>