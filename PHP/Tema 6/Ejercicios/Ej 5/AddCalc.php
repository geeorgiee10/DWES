<?php

require_once 'BaseCalc.php';

class AddCalc extends BaseCalc {
    public function calculate() {
        $result = $this->num1 + $this->num2;
        echo "La suma de {$this->num1} y {$this->num2} es: {$result}\n";
    }
}

?>
