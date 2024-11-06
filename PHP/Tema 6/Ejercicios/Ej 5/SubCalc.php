<?php

require_once 'BaseCalc.php';

class SubCalc extends BaseCalc {
    public function calculate() {
        $result = $this->num1 - $this->num2;
        echo "La resta de {$this->num1} y {$this->num2} es: {$result}\n";
    }
}

?>
