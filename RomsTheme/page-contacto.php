<?php
/**
 * Template Name: Contacto Personalizado RomsPS2
 */
get_header();
?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* Estilos para replicar el diseño morado/oscuro de la imagen original */


body {
    font-family: 'Poppins', sans-serif;
}

body.page-template-page-contacto .content-area {
    /* Asegura que el contenedor principal de la página ocupe todo el espacio */
    min-height: 100vh; 
    
    display: flex;
    justify-content: center;
    align-items: center; /* Alineado arriba para dejar espacio al header */
    padding: 60px 20px;
    box-sizing: border-box;
    
}

.contact-form-wrapper {
    width: 100%;
    max-width: 50%; 
    background-color: #7b43a8; 
    justify-self: center;
    margin: 30px auto;
    padding: 30px;
    border-radius: 15px; /* Bordes redondeados */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
    color: white;
}

.contact-form-wrapper h1 {
    font-size: 2.2em;
    margin-bottom: 25px;
    text-align: center;
    color: white;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
}

/* Estilo para los campos de texto, email y textarea */
input[type="text"],
input[type="email"],
textarea {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 8px; 
    box-sizing: border-box;
    font-size: 1em;
    background-color: white; 
    color: #333;
}

textarea {
    resize: vertical;
    min-height: 120px;
}

/* Estilo para el botón "Enviar" */
.submit-button {
    width: 100%;
    background-color: #3e0b6b; /* Morado oscuro para el botón */
    color: white;
    padding: 15px;
    border: none;
    border-radius: 8px;
    font-size: 1.1em;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
}

.submit-button:hover {
    background-color: #5d1599;
}

/* Estilos para mensajes de feedback */
.form-feedback {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
}
.form-feedback.success {
    background-color: #4CAF50; /* Verde */
}
.form-feedback.error {
    background-color: #f44336; /* Rojo */
}

/* Ocultar el contenido por defecto del editor de WP si lo hubiera */
.entry-content { display: none; }
</style>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <div class="contact-form-wrapper">
            <h1>Contacto</h1>
            
            <?php 
            // Lógica para mostrar mensajes de éxito/error después de la redirección
            if ( isset( $_GET['form_status'] ) ) {
                $status = sanitize_text_field( $_GET['form_status'] );
                
                if ( 'success' === $status ) {
                    echo '<div class="form-feedback success">¡Gracias! Tu mensaje ha sido enviado correctamente.</div>';
                } elseif ( 'error_campos' === $status ) {
                    echo '<div class="form-feedback error">Error: Por favor, rellena todos los campos obligatorios.</div>';
                } elseif ( 'error_envio' === $status ) {
                    echo '<div class="form-feedback error">Error: No pudimos enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.</div>';
                } elseif ( 'error_seguridad' === $status ) {
                    echo '<div class="form-feedback error">Error de seguridad. Recarga la página e inténtalo de nuevo.</div>';
                }
            }
            ?>

            <!--
                El atributo 'action' apunta a admin-post.php, que es el receptor universal de formularios de WP.
                El campo 'action' oculto le dice a admin-post.php qué hook disparar.
            -->
            <form class="contact-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
                
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Tu apellido" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu email" required>
                </div>

                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" placeholder="Tu mensaje" required></textarea>
                </div>

                <!-- 
                    CAMPOS CRÍTICOS PARA LA VINCULACIÓN:
                    1. action: Debe COINCIDIR con el hook que creamos en functions.php
                    2. _wpnonce: Campo de seguridad que requiere verificación en functions.php
                -->
                <input type="hidden" name="action" value="procesar_formulario_contacto">
                <?php wp_nonce_field( 'romsps2_contact_form_action', 'romsps2_contact_nonce' ); ?>
                
                <button type="submit" class="submit-button">Enviar</button>
            </form>
        </div>

    </main>
</div>

<?php get_footer(); ?>