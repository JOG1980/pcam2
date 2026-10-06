<?php

//require_once __DIR__ . '/config/config.php';
//$sombras_texto = $config->sombras_texto;


?>

<!--ENCABEZADO ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------>

<div style="width: 100%; background-color: <?php echo $config_data->app_header_color_fondo;?>">
  <div class="container">
    <div class="row">
      <div class="col-xl-2" style="padding: 0px 5px 5px 5px;">
        <img src="images/editable/logo1.svg" style="width: 290px;">
      </div>
      <div class="col-xl-9" style="padding: 5px 5px 5px 5px; text-align: center;">
        <div style="font-size: 18px; font-weight: bold; color: <?php echo $config_data->titulo1_color; ?> /*#00A969*/; <?php if($config_data->sombras_texto=='1') echo 'text-shadow: 1px 1px 2px #000;' ?>"><?php echo $config_data->titulo1; ?></div>
        <div style="font-size: 18px; font-weight: bold;  color:<?php echo $config_data->titulo2_color; ?> /*#8DC63F*/; <?php if($config_data->sombras_texto=='1') echo 'text-shadow: 1px 1px 2px #000;' ?>""><?php echo $config_data->titulo2; ?></div>
        <div style="font-size: 21px; font-weight: bold; color: <?php echo $config_data->titulo3_color; ?>/*#000000*/; <?php if($config_data->sombras_texto=='1') echo 'text-shadow: 1px 1px 2px #000;' ?>""><?php echo $config_data->titulo3; ?></div>

      </div>
      <div class="col-xl-1" style="padding: 5px 5px 5px 5px; text-align: right;">
        <img src="./images/editable/logo2.jpg" style="width: 120px;">
      </div>
    </div>
  </div>
</div>

