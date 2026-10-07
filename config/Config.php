<?php

//CONFIG_PATH define la ruta ABSOLUTA DEL ARCHIVO DE CONFIGURACION

//Abre un archivo de configuración XML desde su carpeta y lo traduce a datos que PHP puede entender y usar fácilmente. 

//⁠class Config⁠: Es una "caja" donde se agrupan las herramientas que manejan los ajustes del sistema. 

//⁠static function load()⁠ (Método de clase): Permite invocar ⁠Config::load()⁠ directamente en memoria sin instanciar un objeto (⁠new Config⁠). 

//⁠CONFIG_PATH . '/config.xml'⁠: La dirección exacta en la computadora donde está guardado el archivo de configuración. 

//⁠simplexml_load_file()⁠: Lee el archivo ⁠.xml⁠ y convierte su texto en datos organizados dentro de la variable ⁠$xml⁠. 

class Config
{
    static function load()
    {
        $xml = simplexml_load_file(CONFIG_PATH . '/config.xml');
        

        if ($xml === false) {
            echo "Error al cargar el archivo XML.";
        }

        $config_data = (object) [];

        //esta parte es de la app solo es de lectuta --------------------------------------
        $config_data->app_header_color_fondo = (string) $xml->app->header->color_fondo;
        $config_data->app_pagina_login_imagen_fondo = (string) $xml->app->pagina_login->imagen_fondo;
        $config_data->app_pagina_login_imagen_fondo_opacy = (string) $xml->app->pagina_login->imagen_fondo_opacy;
        $config_data->app_pagina_contenido_imagen_fondo = (string) $xml->app->pagina_contenido->imagen_fondo;
       
        //textos
        $config_data->titulo_pagina = (string) $xml->pagina->titulos->titulo_pagina;
        $config_data->titulo1 = (string) $xml->pagina->titulos->titulo1;
        $config_data->titulo2 = (string) $xml->pagina->titulos->titulo2;
        $config_data->titulo3 = (string) $xml->pagina->titulos->titulo3;

        //color textos
        $config_data->titulo_pagina_color = (string) $xml->pagina->texto_color->titulo_pagina_color;
        $config_data->titulo1_color = (string) $xml->pagina->texto_color->titulo1_color;
        $config_data->titulo2_color = (string) $xml->pagina->texto_color->titulo2_color;
        $config_data->titulo3_color = (string) $xml->pagina->texto_color->titulo3_color;

        
        $config_data->sombras_texto = (string) $xml->pagina->sombras_texto;
        
        //canvas
        // $config_data->canvas_usar_background_image = (string) $xml->canvas->usar_background_image;
        // $config_data->canvas_usar_background_color = (string) $xml->canvas->usar_background_color;
        // $config_data->canvas_background_color = (string) $xml->canvas->background_color;
        $config_data->canvas_tipo_fondo = (string) $xml->canvas->tipo_fondo;
        $config_data->canvas_tipo_fondo_opacity = (string) $xml->canvas->tipo_fondo_opacity;
        $config_data->canvas_tipo_fondo_background_color = (string) $xml->canvas->tipo_fondo_background_color;



        $config_data->base_datos_sqlite  = (string) $xml->bd_sqlite->ruta_bd;

        $config_data->archivo_zip_nombre    = (string) $xml->archivo_zip->nombre;
        $config_data->archivo_zip_ext     = (string) $xml->archivo_zip->ext;
        $config_data->archivo_zip_agregar_fecha = (string) $xml->archivo_zip->agregar_fecha;

        //seccion de envio de email
        $config_data->servidor_smtp_ip     = (string) $xml->servidor_smtp->ip;
        $config_data->servidor_smtp_port = (string) $xml->servidor_smtp->port;
        $config_data->servidor_smtp_remitente = (string) $xml->servidor_smtp->remitente;

        return $config_data;
    }

     static function save($config_data)
    {
        $xml = simplexml_load_file(CONFIG_PATH . '/config.xml');
        

        if ($xml === false) {
            echo "Error al cargar el archivo XML.";
        }

        $xml->pagina->titulos->titulo_pagina = $config_data->titulo_pagina;
        $xml->pagina->titulos->titulo1 = $config_data->titulo1;
        $xml->pagina->titulos->titulo2 = $config_data->titulo2;
        $xml->pagina->titulos->titulo3 = $config_data->titulo3;

        //color textos
        $xml->pagina->texto_color->titulo_pagina_color = $config_data->titulo_pagina_color;
        $xml->pagina->texto_color->titulo1_color = $config_data->titulo1_color;
        $xml->pagina->texto_color->titulo2_color = $config_data->titulo2_color;
        $xml->pagina->texto_color->titulo3_color = $config_data->titulo3_color;

        $xml->pagina->sombras_texto = $config_data->sombras_texto;

        //$xml->canvas->usar_background_image = $config_data->canvas_usar_background_image;
        //$xml->canvas->usar_background_color = $config_data->canvas_usar_background_color;
        //$xml->canvas->background_color = $config_data->canvas_background_color;
        $xml->canvas->tipo_fondo = $config_data->canvas_tipo_fondo;
        $xml->canvas->tipo_fondo_opacity = $config_data->canvas_tipo_fondo_opacity;
        $xml->canvas->tipo_fondo_background_color = $config_data->canvas_tipo_fondo_background_color;
        
        $xml->archivo_zip->nombre    = $config_data->archivo_zip_nombre;
        $xml->archivo_zip->agregar_fecha = $config_data->archivo_zip_agregar_fecha;

        //seccionm de envio de emails
        $xml->servidor_smtp->ip     = $config_data->servidor_smtp_ip;
        $xml->servidor_smtp->port = $config_data->servidor_smtp_port;
        $xml->servidor_smtp->remitente = $config_data->servidor_smtp_remitente;

        $xml->asXML(CONFIG_PATH . '/config.xml'); // Sobrescribe el archivo
    }
}
