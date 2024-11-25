<h1>Sacar Carta</h1>

<?php if ($carta): ?>
    <h2>Carta Sacada:</h2>
    
    <p><strong><?php 
    $image = "./assets/img/" . $carta->getPalo()."_".$carta->getNumero().".jpg";
    echo "<img src='$image'/>"; ?></strong></p>
<?php else: ?>
    <p>No hay más cartas en la baraja.</p>
<?php endif; ?>

<h2>Cartas Restantes:</h2>
<ul>
    <?php if (isset($mazo) && !empty($mazo)): ?>
        <?php foreach ($mazo as $carta){
            $image = "./assets/img/" . $carta->getPalo()."_".$carta->getNumero().".jpg";
            echo "<img src='$image'/>";
        }?>
    <?php else: ?>
        <li>No hay cartas restantes en la baraja.</li>
    <?php endif; ?>
</ul>

<a href="?controller=Baraja&action=sacar">
    <button>Sacar otra carta</button>
</a>

