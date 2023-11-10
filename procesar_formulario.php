<?php
// Obtener los datos del formulario
$tallas = explode(',', $_POST['tallas']);
$cantidades = explode(',', $_POST['cantidades']);
$max_prendas_por_caja = intval($_POST['max_prendas']);

// Inicializar la tabla resultante
$resultado = array();

// Iterar sobre las tallas y cantidades
$indice_resultado = 1;
for ($i = 0; $i < count($tallas); $i++) {
    $talla = trim($tallas[$i]);
    $cantidad = intval(trim($cantidades[$i]));

    // Inicializar el número de prenda inicial para esta talla
    $num_prenda_inicial = 1;

    // Distribuir las prendas en las cajas
    while ($cantidad > 0) {
        // Calcular la cantidad de prendas en esta caja
        $prendas_en_caja = min($max_prendas_por_caja, $cantidad);

        // Calcular el número de prenda final en esta caja
        $num_prenda_final = $num_prenda_inicial + $prendas_en_caja - 1;

        // Agregar la entrada a la tabla resultante
        $resultado[] = array($indice_resultado, $talla, $prendas_en_caja, $num_prenda_inicial, $num_prenda_final);

        // Actualizar el índice, la cantidad restante de prendas y el número de prenda inicial
        $indice_resultado++;
        $cantidad -= $prendas_en_caja;
        $num_prenda_inicial += $prendas_en_caja;
    }
}

// Imprimir la tabla resultante
echo "<h2>Tabla Resultante:</h2>";
echo "<table border='1'>";
echo "<tr><th>Número</th><th>Talla</th><th>Cantidad en Caja</th><th>Número de Prenda Inicial</th><th>Número de Prenda Final</th></tr>";
foreach ($resultado as $row) {
    echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td></tr>";
}
echo "</table>";
?>
