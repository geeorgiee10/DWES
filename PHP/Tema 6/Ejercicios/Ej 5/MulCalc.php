<?php

require_once 'BaseCalc.php';

class MulCalc extends BaseCalc {
    public function calculate() {
        $result = $this->num1 * $this->num2;
        echo "La multiplicación de {$this->num1} y {$this->num2} es: {$result}\n";
    }
}

?>
