<?php
$hoy = date_create('now');
echo 'Hoy: ' . $hoy->format('Y-m-d H:i:s') . '<br/>';
$futura = date_create('2025-12-31');
$diferencia = date_diff($hoy, $futura);
echo 'Días hasta el 31/12/2025: ' . $diferencia->format('%R%a días') . '<br/>'; 
echo 'Desglose: ' . $diferencia-> format('%y años, %m meses, %d días, %h horas,%i minutos, %s segundos') . '<br/>';

 