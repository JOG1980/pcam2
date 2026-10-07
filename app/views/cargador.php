<!-- CARGADOR: muestra una pantalla de espera mientras se carga alguna información -->

<div id="wait" 
     style="display:block; position:absolute; top:0%; left:0%; width:100%; height:100%; z-index:10000;">
     
    <!-- Fondo semitransparente que cubre toda la pantalla -->
    <div id="wait" 
         style="display:block; position:absolute; width:100%; height:100%; background-color:white; opacity:0.8;">
         
        <!-- Este div crea el fondo blanco que bloquea visualmente la pantalla -->
    </div>

    <!-- Contenedor que coloca el mensaje de carga en el centro -->
    <div style="display:block; position:absolute; top:50%; left:50%;">
        
        <!-- Cuadro negro donde aparece el GIF y el texto "Cargando..." -->
        <div style="display:block; position:relative; left:-50%; border-radius:25px; text-align:center; width:150px; height:150px; background-color:black; padding:2px; padding:30px 30px 30px 30px;">
            
            <!-- Imagen animada que funciona como indicador de carga -->
            <img src='images/assets/demo_wait.gif' width="64" height="64" />
            
            <!-- Salto de línea para separar la imagen del texto -->
            <br>
            
            <!-- Texto que se muestra debajo del indicador -->
            <span style="color:white;">Cargando...</span>
            
        </div>
    </div>
</div>