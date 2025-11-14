<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo( 'name' ); ?></title>

    <!-- Cargar estilos -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- Encabezado -->
<header>
    <div class="header-container">
        <div class="logo">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo de RomsPS2">
            </a>
        </div>
       
        <nav>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary', 
                'menu_class' => 'main-menu',
                'container' => false
            ));
            ?>
        </nav>
    </div>
</header>

<!-- El contenido de la página empieza después del encabezado -->