<?php
/**
 * Template Name: Página de Información Play Station 2
 * Descripción: Muestra contenido histórico y modelos de la PS2.
 */
get_header();
?>

<style>
body {
    
    background: radial-gradient(#6342C5, #000000); 
    color: white; 
    font-family: Arial, sans-serif;
}

.ps2-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}


.header-hero {
    position: relative;
    height: 60vh; 
    min-height: 400px;
    margin-bottom: 50px;
    border-radius: 10px;
    overflow: hidden;
    background-color: #000;
}

.header-hero img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    filter: brightness(0.8); 
}

.hero-title-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 4em;
    font-weight: 700;
    text-shadow: 0 0 10px rgba(0, 0, 0, 0.8);
    background-color: rgba(0, 0, 0, 0.4); 
    padding: 10px 20px;
    border-radius: 5px;
}



.data-grid-item {
    padding: 30px;
    background: none; 
    border-radius: 8px;
}

.data-grid-wrapper {
    display: grid;

    grid-template-columns: 1fr 1fr; 
    gap: 30px;
    margin-bottom: 50px;
}

.data-grid-item.content-card {
    background: none; 
    padding: 40px;
    display: flex; 
    flex-direction: column;
    justify-content: center;
    align-items: center; 
    text-align: center; 
}

.data-grid-item h2 {
    font-size: 2em;
    font-weight: 700;
    margin-top: 0;
    margin-bottom: 10px;
}

.data-grid-item p {
    color: #ccc;
    line-height: 1.6;
}


.data-grid-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}



.models-title {
    font-size: 2.5em;
    font-weight: 700;
    margin: 60px 0 30px 0;
    border-bottom: 2px solid #6B5ABA;
    padding-bottom: 10px;
}

.models-wrapper {
    display: flex;
    gap: 30px;
}

.model-card {
    flex: 1;
    background: none;
    border-radius: 8px;
    padding: 20px;

}

.model-card h3 {
    font-size: 1.5em;
    margin-top: 0;
}

.model-card p {
    font-size: 0.9em;
    color: #ccc;
}

.model-images {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}

.model-images img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    background-color: none; 
}



@media (max-width: 900px) {
    .data-grid-wrapper {
        grid-template-columns: 1fr; 
    }
    .models-wrapper {
        flex-direction: column; 
    }
    .hero-title-overlay {
        font-size: 3em;
    }
}
</style>

<div class="ps2-container">

    <div class="header-hero">

        <img src="https://placehold.co/1200x600/111111/FFFFFF?text=Play+Station+2+Original" alt="Play Station 2">
        <h1 class="hero-title-overlay">La Play Station 2</h1>
    </div>


    <div class="data-grid-wrapper">

        <div class="data-grid-item content-card">
            <h2>Marzo del 2000</h2>
            <p>El día 4 de marzo del año 2000 se lanzó en Japón la primera edición de la PS2, marcando el inicio de una de las consolas más exitosas de la historia.</p>
        </div>
        
        <div class="data-grid-item">

            <img src="https://placehold.co/500x300/f5f5f5/5D1599?text=Imagen+de+relleno+1" alt="Peras">
        </div>


        <div class="data-grid-item">

            <img src="https://placehold.co/500x300/f5f5f5/5D1599?text=Imagen+de+relleno+2" alt="Sandía">
        </div>
        
        <div class="data-grid-item content-card">
            <h2>160 Millones de unidades</h2>
            <p>A lo largo de su vida, la Play Station 2 vendió un total de 160 millones de unidades, convirtiéndose en la consola de sobremesa más vendida de la historia.</p>
        </div>
    </div>
    
    <!-- 3. MODELOS -->
    <h2 class="models-title">Modelos</h2>

    <div class="models-wrapper">
        
        <!-- Modelo Original -->
        <div class="model-card">
            <div class="model-images">
                <!-- Imagen grande del modelo original -->
                <img src="https://placehold.co/400x600/000000/007bff?text=Modelo+Original" alt="Modelo Original">
            </div>
            <h3>Modelo Original</h3>
            <p>Modelo original de la Play Station 2 con fecha de salida en el año 2000. Destacaba por su diseño voluminoso y el poder de su hardware.</p>
        </div>

        <!-- Modelo Slim -->
        <div class="model-card">
            <div class="model-images">
                <!-- Imagen superior (vista de arriba) -->
                <img src="https://placehold.co/400x150/000000/007bff?text=Modelo+Slim+Vista+Superior" alt="Modelo Slim Superior">
                <!-- Imagen inferior (vista en ángulo) -->
                <img src="https://placehold.co/400x150/000000/007bff?text=Modelo+Slim+Vista+Lateral" alt="Modelo Slim Lateral">
            </div>
            <h3>Modelo Slim</h3>
            <p>Versión compacta que el modelo original, con menos potencia, salida en el año 2004. Mucho más ligera y con fuente de alimentación externa.</p>
        </div>
        
    </div>
    
</div>

<?php get_footer(); ?>