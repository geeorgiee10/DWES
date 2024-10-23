<?php
  date_default_timezone_set('UTC');
  $fechaHoy = date("d/m/Y"); 
  echo "Fecha del dia de hoy: $fechaHoy" . "<br>"; 
  echo "Fecha del dia de mañana: " . date("d/m/Y",strtotime("+ 1 day")) . "<br>"; 
  echo "Fecha del dia de ayer: " . date("d/m/Y",strtotime("- 1 day")); 
?>