<?php

require_once 'AddCalc.php';
require_once 'SubCalc.php';
require_once 'MulCalc.php';
require_once 'DivCalc.php';

$suma = new AddCalc(20, 12);
$suma->calculate();

$resta = new SubCalc(13, 4);
$resta->calculate();

$multiplicacion = new MulCalc(9, 2);
$multiplicacion->calculate();

$division = new DivCalc(15, 3);
$division->calculate();



?>
