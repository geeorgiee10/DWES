<?php
define("TITULO", "Don Quijote de la Mancha");
if ( defined( "TITULO")) {
echo " El título del libro es :  ". TITULO;
}

echo "<br>";

const TITULO2 = "Don Quijote";
if ( defined( "TITULO2")) {
echo " El título del libro es :  ". TITULO2;
}