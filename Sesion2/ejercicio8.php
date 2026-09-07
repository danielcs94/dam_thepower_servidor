<?php
$titulo="              Informe Mensual                  ";
$tope="||";
$ititulo=$tope.ltrim($titulo).$tope;
$dtitulo=$tope.rtrim($titulo).$tope;
$idtitulo=$tope.trim($titulo).$tope;
echo "izquierda $ititulo<br>";
echo "derecha $dtitulo<br>";
echo "izquierda derecha $idtitulo<br>";

$cadenaarr="1,2,3,4";
$arrcadena=explode(",",$cadenaarr);

echo "$arrcadena[0]<br>";

$cadenaarr2=implode("||",$arrcadena);

echo $cadenaarr2;