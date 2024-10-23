<?php
    echo "<table border='1'>";
    foreach ($_SERVER as $key => $value) {
        echo "<tr>";
            echo "<td>" . htmlspecialchars($key) . "</td>";
            echo "<td>" . htmlspecialchars($value) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>

