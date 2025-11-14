<?php
/**
 * Template Name: Página de Noticias Personalizada RomsPS2
 */
get_header();
?>

<style>
/* * ESTILOS ESPECÍFICOS PARA LA PÁGINA DE NOTICIAS 
 *
 * NOTA: Aplicamos estilos de fondo similares al home para consistencia.
 * Esto debería ser manejado por el style.css de tu tema, pero lo incluimos aquí 
 * para asegurar el aspecto visual.
 */
body { 
    font-family: Arial, sans-serif; 
    background: radial-gradient(#6342C5, #000000); 
    color: white; 
    /* Padding para compensar el header si es fijo */
    padding-top: 0;
}

.noticias-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* --- ESTILOS DE NOTICIA DESTACADA (ULTIMA NOTICIA) --- */

.featured-news-title {
    font-size: 2.5em;
    font-weight: 700;
    margin: 40px 0 20px 0;
    padding-left: 20px;
}

.featured-news-wrapper {
    display: flex;
    gap: 40px;
    align-items: center;
    padding: 20px;
    background-color: none; /* Fondo oscuro similar al card */
    border-radius: 10px;
    margin-bottom: 60px;
}

.featured-news-image {
    width: 50%;
    min-width: 300px; /* Evita que la imagen sea demasiado pequeña en móvil */
    height: 400px;
    overflow: hidden;
    border-radius: 8px;
}

.featured-news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.featured-news-content {
    width: 50%;
}

.featured-news-content h2 {
    font-size: 1.8em;
    margin-top: 0;
}

.featured-news-content p {
    color: #ccc;
    line-height: 1.6;
}

.featured-news-content .btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 25px;
    background: #6B5ABA;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.featured-news-content .btn:hover {
    background-color: none;
}

/* --- ESTILOS DE GRID DE NOTICIAS (TODAS LAS NOTICIAS) --- */

.all-news-title {
    font-size: 2em;
    font-weight: 700;
    margin: 40px 0 20px 20px;
}

.news-grid {
    display: grid;
    /* 3 columnas en escritorio, adaptable */
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 20px;
}

.news-card-item {
    background: none;
    border-radius: 8px;
    overflow: hidden;
}

.news-card-item a {
    text-decoration: none;
    color: inherit;
    display: block;
}

.news-card-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}

.news-card-content {
    padding: 15px;
}

.news-card-content h3 {
    font-size: 1.3em;
    margin: 10px 0 5px 0;
}

.news-card-content p {
    font-size: 0.9em;
    color: #ccc;
}

/* --- ADAPTACIÓN MÓVIL --- */
@media (max-width: 768px) {
    .featured-news-wrapper {
        flex-direction: column;
    }
    .featured-news-image,
    .featured-news-content {
        width: 100%;
        min-width: auto;
    }
    .featured-news-image {
        height: 300px;
    }
}
</style>

<div class="noticias-container">

    <h1 class="featured-news-title">Última noticia</h1>

    <?php
    // Query para la Última Noticia (la más reciente)
    $latest_news = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'order'          => 'DESC',
        'orderby'        => 'date'
    ]);

    if ($latest_news->have_posts()) :
        while ($latest_news->have_posts()) : $latest_news->the_post();
            $post_id = get_the_ID();
            $thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'large') : 'https://placehold.co/600x400/220044/FFFFFF?text=Sin+Imagen';
            ?>
            <div class="featured-news-wrapper">
                <div class="featured-news-image">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                </div>

                <div class="featured-news-content">
                    <h2><?php the_title(); ?></h2>
                    <p>Subtítulo 1</p> <!-- Este texto es estático en el diseño, si viene de ACF, hay que adaptarlo -->
                    <p>
                        <?php 
                        // Muestra el extracto, o si no hay extracto, el contenido limitado.
                        echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 50, '...'); 
                        ?>
                    </p>
                    <a class="btn" href="<?php the_permalink(); ?>">
                        Ir a la noticia
                    </a>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p class="featured-news-title">No hay noticias destacadas.</p>';
    endif;
    ?>
    
    <h2 class="all-news-title">Todas las noticias</h2>

    <div class="news-grid">
    <?php
    // Query para el resto de noticias, excluyendo la primera (la destacada)
    $remaining_news = new WP_Query([
        'post_type'      => 'post',
        'posts_per_page' => 6, // Muestra 6 más
        'offset'         => 1,  // Excluye la primera noticia
        'order'          => 'DESC',
        'orderby'        => 'date'
    ]);

    $noticia_count = 2; // Para generar "Noticia 2", "Noticia 3", etc.

    if ($remaining_news->have_posts()) :
        while ($remaining_news->have_posts()) : $remaining_news->the_post();
            $post_id = get_the_ID();
            $thumbnail_url = has_post_thumbnail() ? get_the_post_thumbnail_url($post_id, 'medium') : 'https://placehold.co/300x200/220044/FFFFFF?text=Sin+Imagen';
            ?>
            <div class="news-card-item">
                <a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                    <div class="news-card-content">
                        <h3>Noticia <?php echo $noticia_count++; ?></h3> <!-- Usamos el contador para simular el título del diseño -->
                        <p>Descripción de la noticia</p>
                    </div>
                </a>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>No hay más noticias disponibles.</p>';
    endif;
    ?>
    </div>
    
</div>

<?php get_footer(); ?>