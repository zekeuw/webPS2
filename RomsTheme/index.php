<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>RomsPS2</title>
    <style>
        body { font-family: Arial; background:radial-gradient(#6342C5,#000000); color:white; }
        nav a { color:#fff; margin:0 10px; text-decoration:none; }
        .hero { padding:40px; text-align:left}
        .hero img {display:block; margin: 0 auto; height: 700px; object-fit: cover; width:70%; border-radius:8px; }
        h2 { margin-left:20px; }
        .games, .news, .ps2-section, .comments { display:flex; gap:20px; padding:20px; overflow-x:auto; }
        .card { background:#220044; padding:15px; width:180px; border-radius:8px; text-align:center; }
        .card img { width:100%; border-radius:5px; }
        .news {display: grid;grid-template-columns: 1fr 1fr; gap: 20px; padding: 20px 40px; max-width: 1200px; margin: 0 auto;}
        .news-card { background: none; padding:15px; border-radius:8px; width:300px; }
        .news-card img { width:100%; border-radius:8px; }
        .btn { display:inline-block; margin:10px; padding:10px 20px; background:#6B5ABA; color:white; text-decoration:none; border-radius:5px; }
        .videojuegos-grid {grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)) !important; }
        .videojuegos-grid {padding:40px;display: grid;grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));gap: 25px;margin-top: 20px; }
        .seccion-titulo {padding:40px}
    </style>
</head>
<body>

<header>
    <?php get_header() ?>
</header>

<div class="hero">
    <h1>RomsPS2</h1>
    <p>La web de roms mas segura de mi casa</p>
    <a class="btn">Juegos</a>
    <br><br>
    <img src="http://localhost/PS2roms/wordpress/wp-content/uploads/2025/11/61pETE6v4vL-2153248495.jpg" alt="Imagen estática">
</div>

<h1 class="seccion-titulo">Juegos destacados:</h1>
<div class="videojuegos-grid">
    <?php
    $destacados = new WP_Query(array(
        'post_type' => 'videojuegos',
        'posts_per_page' => 3,
        'orderby' => 'rand'
    ));
    if ($destacados->have_posts()) :
        while ($destacados->have_posts()) : $destacados->the_post(); ?>
            <div class="videojuego-item">
                <a href="<?php the_permalink(); ?>">
                    <div class="caratula">
                        <?php if (has_post_thumbnail()) {
                            the_post_thumbnail('medium');
                        } else {
                            echo '<img src="' . esc_url(get_template_directory_uri() . '/assets/no-image.jpg') . '" alt="Sin imagen">';
                        } ?>
                    </div>
                </a>
                <h3><?php the_title(); ?></h3>
                <p><?php the_terms(get_the_ID(), 'categorias_videojuegos', '', ', '); ?></p>
            </div>
        <?php endwhile;
        wp_reset_postdata();
    else :
        echo '<p>No hay juegos destacados aún.</p>';
    endif;
    ?>
</div>



<h1>Noticias</h1>
<div class="news">
<?php

$noticias = new WP_Query([
    'post_type'      => 'post',     
    'posts_per_page' => 2,         
    'order'          => 'DESC'
]);

while ($noticias->have_posts()) : $noticias->the_post(); ?>

    <div class="news-card">
        <?php if (has_post_thumbnail()): ?>
            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
        <h3><?php the_title(); ?></h3>
        <p><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
    </div>

<?php endwhile;
wp_reset_postdata();
?>
</div>

<div style="text-align:center;">
    <a class="btn" href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">
        Más noticias
    </a>
</div>

<h1 style="margin-left:20px;">Sobre nosotros</h1>

<div class="sobre-nosotros" 
     style="max-width: 1200px; margin: auto; padding: 40px 20px;
            display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">

    
    <div class="columna-izquierda" style="font-size: 1.2rem;">

        <h2>Conservación</h2>
        <p>Nos comprometemos con la conservación del medio ambiente.</p>

        <h2>Comunidad</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

        <h2>L'Oréal Paris</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>

    
    <div class="columna-derecha" style="text-align: center;">
        <img src="http://localhost/PS2roms/wordpress/wp-content/uploads/2025/11/17423-3277708430.jpg" 
             alt="Historia PS2"
             style="width: 100%; border-radius: 10px; max-width: 400px;">
    </div>

<div style="text-align:center;">
    <a class="btn" href="<?php echo get_permalink( get_option('page_for_posts') ); ?>">
            Contactanos
    </a>

</div>
</div>

<h1 class="seccion-titulo">Que dice mi gente</h1>

<div class="testimonios-grid">
<?php
$comentarios = new WP_Query([
    'post_type' => 'comentarios',
    'posts_per_page' => 3,
    'order' => 'rand'
]);

if ($comentarios->have_posts()) :
    while ($comentarios->have_posts()) : $comentarios->the_post();

        $nombre = get_post_meta(get_the_ID(), 'nombre', true);
        $descripcion = get_post_meta(get_the_ID(), 'descripcion', true);
?>
        <div class="testimonio-card">
            
            <!-- Comentario -->
            <h3><?php the_title(); ?></h3>

            <!-- Avatar + info -->
            <div class="testimonio-avatar">
                <?php 
                if (has_post_thumbnail()) {
                    the_post_thumbnail('thumbnail');
                } else {
                    echo '<img src="'.get_template_directory_uri().'/assets/avatar-default.jpg" alt="avatar">';
                }
                ?>
                
                <div class="testimonio-info">
                    <strong><?php echo esc_html($nombre ?: 'Nombre'); ?></strong>
                    <span><?php echo esc_html($descripcion ?: 'Descripción'); ?></span>
                </div>
            </div>

        </div>
<?php
    endwhile;
    wp_reset_postdata();
endif;
?>
</div>

</div>

<footer>
    <?php get_footer() ?>
</footer>

</body>
</html>
