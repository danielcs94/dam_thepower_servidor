<?php
$titulo="Informe Mensual";
$contenidoHeredoc=<<<TEXTO
Este es un ejemplo de Heredoc
El título del informe es:"$titulo".
Podemos usar "comillas dobles" sin problema.
Y saltos  de 
línea.
TEXTO;
echo nl2br($contenidoHeredoc);
