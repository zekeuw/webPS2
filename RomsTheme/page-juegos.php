<?php
/*
Template Name: Página de Juegos
*/
get_header();
?>

<style>
.videojuegos-container {
    padding: 40px;
    max-width: 1200px;
    margin: 0 auto;
    color: white;
    font-family: 'Poppins', sans-serif;
}
.videojuegos-categorias {
    margin-bottom: 40px;
}
.videojuegos-categorias h2 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}
.videojuegos-categorias a {
    display: inline-block;
    background: #333;
    color: white;
    padding: 6px 14px;
    margin: 5px;
    border-radius: 20px;
    text-decoration: none;
    transition: 0.2s;
}
.videojuegos-categorias a:hover {
    background: #6d00ff;
}
.videojuegos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 25px;
    margin-top: 20px;
}
.videojuego-item {
    background: transparent;
    border-radius: 15px;
    padding: 10px;
    text-align: center;
    box-shadow: none;
    transition: transform 0.2s;
}
.videojuego-item:hover {
    transform: scale(1.03);
}
.videojuego-item .caratula {
    position: relative;
    width: 100%;
    padding-top: 150%;
    overflow: hidden;
    border-radius: 10px;
    margin-bottom: 10px;
    background: #000;
}

.videojuego-item .caratula img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.videojuego-item h3 {
    font-size: 1.1rem;
    margin: 5px 0;
}
.videojuego-item p {
    font-size: 0.9rem;
    color: #ccc;
    margin: 0;
}
.seccion-titulo {
    font-size: 1.6rem;
    margin-top: 40px;
    border-bottom: 1px solid #555;
    padding-bottom: 8px;
}
.videojuego-item p a {
    color: white !important;
    text-decoration: none;
}

.videojuego-item p a:hover {
    text-decoration: underline;
}
.videojuegos-grid {
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)) !important;
}
</style>

<div class="videojuegos-container">

    <div class="videojuegos-categorias">
        <h2>Categorías:</h2>
        <?php
        $terms = get_terms(array(
            'taxonomy' => 'categorias_videojuegos',
            'hide_empty' => true,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                echo '<a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a>';
            }
        } else {
            echo '<p>No hay categorías disponibles.</p>';
        }
        ?>
    </div>

    <h2 class="seccion-titulo">Juegos destacados:</h2>
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


    <h2 class="seccion-titulo">Todos los juegos:</h2>
    <div class="videojuegos-grid">
        <?php
        $todos_juegos = new WP_Query(array(
            'post_type' => 'videojuegos',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        ));

        if ($todos_juegos->have_posts()) :
            while ($todos_juegos->have_posts()) : $todos_juegos->the_post(); ?>
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
            echo '<p>No hay videojuegos disponibles.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
