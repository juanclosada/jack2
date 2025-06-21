<?php

session_start();
require 'conexion.php';

$sql = "SELECT * FROM productos";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['nombre'] . "</h3>";
    echo "<p>Precio: $" . $row['precio'] . "</p>";
       if ($row['cantidad'] > 0) {
        echo "<p>Disponible: " . $row['cantidad'] . "</p>";
        echo "<form method='POST' action='vender.php'>
                <input type='hidden' name='id' value='" . $row['id'] . "'>
                <input type='number' name='cantidad' min='1' max='" . $row['cantidad'] . "' value='1'>
                <button type='submit'>Vender</button>
              </form>";
    } else {
        echo "<p style='color:red;'>Producto agotado</p>";
    }

    echo "</div><hr>";
}
$conn->close();
?>
