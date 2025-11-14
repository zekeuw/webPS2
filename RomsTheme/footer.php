<?php
/**
 * footer.php
 */
?>

<footer class="site-footer" role="contentinfo">
    <div class="footer-container">

        <!-- Columna izquierda -->
        <div class="footer-brand">
            <h2 class="brand-title">RomsPS2</h2>
            <div class="footer-social" aria-label="Redes sociales">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Columnas de enlaces -->
        <div class="footer-links" role="navigation" aria-label="Enlaces de pie de página">
            <div class="footer-col">
                <h4>Páginas</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/pagina-1')); ?>">Página 1</a></li>
                    <li><a href="<?php echo esc_url(home_url('/pagina-2')); ?>">Página 2</a></li>
                    <li><a href="<?php echo esc_url(home_url('/pagina-3')); ?>">Página 3</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Información</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/sobre-nosotros')); ?>">Sobre nosotros</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contacto')); ?>">Contacto</a></li>
                    <li><a href="<?php echo esc_url(home_url('/historia-ps2')); ?>">Historia PS2</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Categorías</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/categoria-1')); ?>">Categoría 1</a></li>
                    <li><a href="<?php echo esc_url(home_url('/categoria-2')); ?>">Categoría 2</a></li>
                    <li><a href="<?php echo esc_url(home_url('/categoria-3')); ?>">Categoría 3</a></li>
                </ul>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
