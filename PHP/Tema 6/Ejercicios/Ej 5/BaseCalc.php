<?php

class BaseCalc {
    protected float $num1;
    protected float $num2;

    public function __construct(float $num1, float $num2) {
        $this->num1 = $num1;
        $this->num2 = $num2;
    }

    public function calculate() {
        echo "Número 1: {$this->num1}, Número 2: {$this->num2}\n";
    }
}

?>
