<?php get_header(); ?>

<main class="videojuego-single" style="color: white; padding: 50px 0; font-family: Arial, sans-serif;">

    <?php while (have_posts()) : the_post(); ?>

        <section class="contenedor" style="max-width: 1200px; margin: auto; display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: start;">
            
            <!-- Columna Izquierda -->
            <div class="columna-izquierda">

                <h1 style="font-size: 3rem; margin-bottom: 10px;"><?php the_title(); ?></h1>

                <p style="font-size: 1.2rem; margin-bottom: 10px;">
                    <strong>Categoría:</strong> 
                    <?php 
                        $cats = get_the_terms(get_the_ID(), 'categorias_videojuegos');
                        if ($cats && !is_wp_error($cats)) {
                            $nombres = wp_list_pluck($cats, 'name');
                            echo esc_html(implode(', ', $nombres));
                        }
                    ?>
                </p>

                <div class="descripcion" style="margin-bottom: 20px; font-size: 1.1rem;">
                    <?php the_content(); ?>
                </div>

                <!-- Gameplay -->
                <?php 
                $video = get_field('gameplay');
                if ($video) :

                    // Convertir URL normal de YouTube a formato embed
                    if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/|shorts\/))([a-zA-Z0-9_-]+)/', $video, $matches)) {
                        $video_id = $matches[1];
                        $video = 'https://www.youtube.com/embed/' . $video_id;
                    }
                ?>
                    <h2 style="font-size: 1.5rem; margin-top: 30px;">Gameplay:</h2>
                    <div class="video" style="margin-top: 15px;">
                        <iframe width="100%" height="315" src="<?php echo esc_url($video); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>


            </div>

            <!-- Columna Derecha -->
            <div class="columna-derecha" style="text-align: center; width: 50%; justify-self: center; align-self: center;">

                <?php if (has_post_thumbnail()) : ?>
                    <div class="imagen-portada" style="margin-bottom: 20px;">
                        <?php the_post_thumbnail('medium', ['style' => 'width:100%; height:100%; border-radius: 10px;']); ?>
                    </div>
                <?php endif; ?>

                <?php 
                    $link1 = get_post_meta(get_the_ID(), '_link1', true);
                    $link2 = get_post_meta(get_the_ID(), '_link2', true);
                ?>

                <?php if ($link1) : ?>
                    <p><a href="<?php echo esc_url($link1); ?>" target="_blank" style="display: block; background: #7b4dff; color: white; padding: 10px; border-radius: 10px; margin: 10px 0; text-decoration: none;">Link 1</a></p>
                <?php endif; ?>

                <?php if ($link2) : ?>
                    <p><a href="<?php echo esc_url($link2); ?>" target="_blank" style="display: block; background: #7b4dff; color: white; padding: 10px; border-radius: 10px; margin: 10px 0; text-decoration: none;">Link 2</a></p>
                <?php endif; ?>

            </div>

        </section>

        

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
