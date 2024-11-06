<?php

require_once 'BaseCalc.php';

class DivCalc extends BaseCalc {
    public function calculate() {
        if ($this->num2 == 0) {
            echo "Error: No se puede dividir por cero.\n";
        } else {
            $result = $this->num1 / $this->num2;
            echo "La división de {$this->num1} entre {$this->num2} es: {$result}\n";
        }
    }
}

?>
