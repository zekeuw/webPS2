<?php
/**
 * Plantilla para mostrar entradas individuales (noticias)
 * Basada en el estilo oscuro/morado de RomsPS2.
 */

get_header();
$featured_image_url = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : 'https://placehold.co/1000x500/3e0b6b/FFFFFF?text=Imagen+No+Disponible';
?>

<style>

.single-post-container {
    max-width: 1100px; 
    width: 90%; 
    min-height: 100vh; 
    margin: 0 auto;
    padding: 40px 20px;
    color: white;
}

.entry-title {
    font-size: 3em;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.1;
}

.entry-meta {
    color: #ccc;
    font-size: 0.9em;
    margin-bottom: 40px;
    border-bottom: 1px solid #444;
    padding-bottom: 15px;
}
.entry-meta a {
    color: #999;
    text-decoration: none;
}
.entry-meta a:hover {
    color: #fff;
}


.featured-image-single {
    width: 100%;
    height: auto; 
    margin-bottom: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
    background-color: #3e0b6b; 
}
.featured-image-single img {
    width: 100%;
    height: auto; 
    display: block;
}


.entry-content {
    font-size: 1.1em;
    line-height: 1.7;
    margin-bottom: 50px;
}
.entry-content h1, .entry-content h2, .entry-content h3 {
    color: white; 
    margin-top: 1.5em;
    margin-bottom: 0.5em;
}
.entry-content a {
    color: #6B5ABA; 
    text-decoration: none;
    font-weight: bold;
}

#comments {
    display: none;
}
.post-navigation a{
    color: #FFFFFF;
}
</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main single-post-container">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        Publicado el <?php echo get_the_date(); ?> por <?php the_author_posts_link(); ?>
                        <span class="sep"> | </span>
                        Categoría: <?php the_category(', '); ?>
                    </div>
                </header>
                
                <div class="featured-image-single">
                    <img src="<?php echo esc_url($featured_image_url); ?>" alt="<?php the_title_attribute(); ?>">
                </div>

                <div class="entry-content">
                    <?php
                    the_content( sprintf(
                        wp_kses(
                            __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'romsps2' ),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ) );

                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'romsps2' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <div class="post-navigation" style="display:flex; justify-content:space-between; margin-top:40px; padding-top:20px; border-top:1px solid #444;">
                    <?php previous_post_link('<span class="nav-prev">%link</span>', '← Noticia Anterior'); ?>
                    <?php next_post_link('<span class="nav-next">%link</span>', 'Noticia Siguiente →'); ?>
                </div>
                <?php
                ?>
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php
        endwhile;

    else :

        echo '<h1 class="entry-title">Noticia no encontrada</h1>';
        echo '<p>Parece que no podemos encontrar lo que estás buscando. Intenta buscar de nuevo.</p>';
    endif;
    ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>